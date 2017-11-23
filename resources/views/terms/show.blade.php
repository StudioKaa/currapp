@extends('layouts.app')

@section('breadcrumbs')
    <ol class="my-breadcrumb navbar-text">
        <li class="breadcrumb-item">
            <a href="/educations/{{ $education->id }}">{{ $education->title }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/cohorts/{{ $cohort->id }}">{{ $cohort->title }}</a>
            <!-- <select class="cohort-select" id="to-cohort">
                @foreach($cohort->education->cohorts as $c)
                    <option value="{{ $c->id }}" <?php echo $c->id == $cohort->id ? 'selected' : '' ?>>
                        {{ $c->start_year }} - {{ $c->exam_year }}
                    </option>
                @endforeach
            </select> -->
        </li>
        <li class="breadcrumb-item">
            {{ $term->title }}
        </li>
    </ol>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/{{ $cohort->id }}">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> Overzicht
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/lesson_types/create?term={{ $term->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> Lesvorm
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $term->title }}
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/term.css') }}">
@endpush

@section('content')

    <div class="term-grid">
        @for($i = 1; $i <= 8; $i++)
            <div class="week-number">
                <h5>{{ $i }}</h5>
            </div>
        @endfor

        @foreach ($lesson_types as $lesson_type)
            
            <div class="lesson-type-title">
                <div>
                    <h5>{{ $lesson_type->title }}</h5>
                    <p>{{ $lesson_type->sub_title }}</p>
                </div>
                @if(Auth::user()->type == 'teacher')
                    <div class="icons btn-group">
                        <a href="/lesson_types/{{ $lesson_type->id }}/edit" class="btn btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="/lessons/create?lesson_type={{ $lesson_type->id }}" class="btn btn-outline-secondary"><i class="fa fa-plus" aria-hidden="true"></i> Les</a>
                    </div>
                @endif
            </div>
            
            @foreach($lesson_type->lessons()->get() as $lesson) 
                <div class="card duration-{{ $lesson->duration }} bg-{{ $lesson->status()->context_class }} start-{{ $lesson->week_start }}">
                    <div class="card-body">
                        <p class="card-title"><a href="/lessons/{{ $lesson->id }}">{{ $lesson->title }}</a></p>
                    </div>
                </div>
            @endforeach

        @endforeach
    </div>
    
@endsection