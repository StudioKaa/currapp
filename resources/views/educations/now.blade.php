@extends('layouts.app')

@section('breadcrumbs')
    <ol class="my-breadcrumb navbar-text">
        <li class="breadcrumb-item">
            <a href="/educations/{{ $education->id }}">{{ $education->title }}</a>
        </li>
    </ol>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

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