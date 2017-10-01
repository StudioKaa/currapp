@extends('layouts.app')

@section('page-title')
    > {{ $education->title }}
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/create?education={{ $education->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> Cohort
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/educations/{{ $education->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $education->title }}
    </a>
@endsection

@section('content')

    <div class="card-deck">
        @foreach ($cohorts as $cohort)
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h4 class="card-title">{{ $education->title }} {{ $cohort->start_year }} - {{ $cohort->exam_year }}</h4>
                    <a class="btn btn-outline-primary" href="{{ url('cohorts', [$cohort->id]) }}">Bekijk {{ $cohort->start_year }} - {{ $cohort->exam_year }}</a>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection