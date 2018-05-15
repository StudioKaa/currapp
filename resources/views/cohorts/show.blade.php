@extends('layouts.app')

@section('buttons-student')
    <a class="btn btn-outline-secondary navbar-text" href="/educations/{{ $education->id }}">
        <i class="fa fa-chevron-up" aria-hidden="true"></i> Omhoog
    </a>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/create?cohort={{ $cohort->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> <span>Periode</span>
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

@section('content')

    <div class="cohort-grid" style="grid-template-columns: repeat({{ $education->terms_per_year }}, 1fr);">
        @foreach ($terms as $term)
            <a class="link-card" href="{{ url('terms', [$term->id]) }}"
                style="grid-column: {{ $term->order_in_year }} / span {{ $term->duration }};">
                <h4>{{ $term->title }}</h4>
                <p class="card-text">{{ $term->sub_title }}</p>
            </a>
        @endforeach
    </div>
    
@endsection