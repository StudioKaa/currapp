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

@section('content')

    @foreach ($terms as $year_of_study)
        <div class="card-deck">
            @foreach ($year_of_study as $term)
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h4 class="card-title">{{ $term->title }}</h4>
                        <p class="card-text">{{ $term->sub_title }}</p>
                        <a class="btn btn-outline-primary" href="{{ url('terms', [$term->id]) }}">Bekijk {{ $term->title }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    
@endsection