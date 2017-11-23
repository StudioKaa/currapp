@extends('layouts.app')

@section('page-title')
    > <a class="navbar-text" href="/educations/{{ $cohort->education->id }}">{{ $cohort->education->title }}</a>
    > 
    <select class="cohort-select" id="to-cohort">
        @foreach($cohort->education->cohorts as $c)
            <option value="{{ $c->id }}" <?php echo $c->id == $cohort->id ? 'selected' : '' ?>>
                {{ $c->start_year }} - {{ $c->exam_year }}
            </option>
        @endforeach
    </select>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/create?cohort={{ $cohort->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> Periode
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/{{ $cohort->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $cohort->start_year }} - {{ $cohort->exam_year }}
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

@section('content')

    <div class="cohort-grid columns-{{ $cohort->education->terms_per_year }}">
        @foreach ($terms as $term)
            <a class="link-card term-span-{{ $term->duration }}" href="{{ url('terms', [$term->id]) }}">
                <h4>{{ $term->title }}</h4>
                <p class="card-text">{{ $term->sub_title }}</p>
            </a>
        @endforeach
    </div>
    
@endsection