@extends('layouts.app')

@section('breadcrumbs')
    <ol class="my-breadcrumb navbar-text">
        <li class="breadcrumb-item">
            {{ $education->title }}
        </li>
    </ol>
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

    <div class="card-container">
        @foreach ($cohorts as $cohort)
            <a class="link-card" href="{{ url('cohorts', [$cohort->id]) }}">
                <h4>{{ $education->title }} {{ $cohort->title }}</h4>
                <p class="card-text">{{ $cohort->description }}</p>
            </a>
        @endforeach
    </div>
    
@endsection