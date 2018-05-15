@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/create?education={{ $education->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> <span>Cohort</span>
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/educations/{{ $education->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> <span>{{ $education->title }}</span>
    </a>
@endsection

@section('content')
    
    <p class="d-flex justify-content-end"><a href="{{ url('educations', $education->id) }}">Bekijk alle cohorten (geschiedenis) &gt;</a></p>

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