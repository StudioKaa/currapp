<?php 
use Carbon\Carbon;
Carbon::setLocale(config('app.locale')); ?>

@extends('layouts.app')

@section('page-title')
    > <a class="navbar-text" href="/educations/{{ $education->id }}">{{ $education->title }}</a>
    > <a class="navbar-text" href="/cohorts/{{ $cohort->id }}">{{ $cohort->start_year }} - {{ $cohort->exam_year }}</a>
    > <a class="navbar-text" href="/terms/{{ $term->id }}">{{ $term->title }}</a>
    > {{ $lesson_type->title }}: {{ $lesson->title }}
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> Overzicht
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/lessons/{{ $lesson->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $lesson->title }}
    </a>
@endsection

@section('content')

    <div class="row my-spacing">
        <div class="col-12">
            <h3>{{ $lesson_type->title }}: {{ $lesson->title }}</h3>
        </div>
    </div>

    <div class="row my-spacing">
        <div class="col-6 d-flex flex-column">
            @if(Auth::user()->type == 'teacher' && $review != null)
                @include('reviews.partial_teacher')
                <h6 class="my-spacing" id="history-title"><a data-toggle="collapse" class="collapsed" href="#history-content">Geschiedenis <span>&raquo;</span></a></h6>
                <div class="collapse" id="history-content">
                    @foreach($history as $review)
                        @include('reviews.partial_teacher')
                    @endforeach
                </div>
            @elseif(Auth::user()->type == 'teacher' && $review == null)
                <div class="btn-group review-buttons">
                    <a href="/reviews/create?lesson={{ $lesson->id }}" class="card-link btn btn-outline-primary">Eerste versie uploaden</a>
                    <a href="/reviews/addwiki?lesson={{ $lesson->id }}" class="card-link btn btn-outline-primary"><i class="fa fa-link"></i> Wiki-link</a>
                </div>
            @elseif(Auth::user()->type == 'student' && $review != null)
                @include('reviews.partial_student')
            @endif
        </div>

        <div class="col-6">
            @if(count($files) || Auth::user()->type == 'teacher')
                @include('files.partial_' . Auth::user()->type)
            @endif
        </div>
    </div>
    
@endsection