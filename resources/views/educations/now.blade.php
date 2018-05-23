@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

@section('buttons-student')
    <a class="btn btn-outline-secondary navbar-text" href="/educations">
        <i class="fa fa-chevron-up" aria-hidden="true"></i> Omhoog
    </a>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/create?education={{ $education->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> <span>Cohort</span>
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/educations/{{ $education->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> <span>{{ $education->title }}</span>
    </a>
@endsection

@section('content')
    
    <ul class="nav nav-tabs mb-5 justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('educations.show', $education) }}">Alle jaren</a>
        </li>
        <li class="nav-item mr-3">
            <a class="nav-link active">Dit jaar</a>
        </li>
    </ul>

    <div class="cohort-grid" style="grid-template-columns: 90px repeat({{ $education->terms_per_year }}, 1fr);">
        @foreach ($terms as $schoolyear => $year)
            <div class="schoolyear">
                <p><strong>Jaar {{ $schoolyear }}</strong></p>
                <em>{{ $year[0]->cohort->title }}</em>
            </div>
            @foreach ($year as $term)
                <a class="link-card" href="{{ url('terms', [$term->id]) }}"
                    style="grid-column: {{ $term->order_in_year+1 }} / span {{ $term->duration }};">
                    <h4>{{ $term->title }}</h4>
                    <p class="card-text">{{ $term->sub_title }}</p>
                </a>
            @endforeach
        @endforeach
    </div>
    
@endsection