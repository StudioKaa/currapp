<?php 
use Carbon\Carbon;
Carbon::setLocale(config('app.locale')); ?>

@extends('layouts.app')

@section('page-title')
    > <a class="navbar-text" href="/educations/{{ $education->title }}/now">{{ $education->title }}</a>
    > <a class="navbar-text" href="/cohorts/{{ $cohort->id }}">{{ $cohort->start_year }} - {{ $cohort->exam_year }}</a>
    > <a class="navbar-text" href="/terms/{{ $term->id }}">{{ $term->title }}</a>
    > {{ $lesson_type->title }}: {{ $lesson->title }}
@endsection

@section('breadcrumbs')
    <ol class="my-breadcrumb navbar-text">
        <li class="breadcrumb-item">
            <a href="/educations/{{ $education->id }}">{{ $education->title }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/cohorts/{{ $cohort->id }}">{{ $cohort->title }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/terms/{{ $term->id }}">{{ $term->title }}</a>
        </li>
        <li class="breadcrumb-item">{{ $lesson_type->title }}</li>
        <li class="breadcrumb-item">{{ $lesson->title }}</li>
    </ol>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> Overzicht
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/lessons/{{ $lesson->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $lesson->title }}
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/lesson.css') }}">
@endpush

@section('content')
    
<div class="lesson-container">

    <h3>{{ $lesson_type->title }}: {{ $lesson->title }}</h3>

    <div class="btn-group review-buttons">
        @if(Auth::user()->type == 'teacher')
            <span class="btn btn-outline-primary">{{ $review == null ? 'Eerste' : 'Nieuwe' }} versie:</span>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/file" class="card-link btn btn-outline-primary"><i class="fa fa-file-text-o"></i> bestand</a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/wiki" class="card-link btn btn-outline-primary"><i class="fa fa-link"></i> wiki</a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/text" class="card-link btn btn-outline-primary"><i class="fa fa-font"></i> tekst</a>
        @endif
    </div>

    <div class="reviews">
        @if(Auth::user()->type == 'teacher' && $review != null)
            @include('reviews.partial_teacher')
            <h6 class="my-spacing" id="history-title"><a data-toggle="collapse" class="collapsed" href="#history-content">Geschiedenis <span>&raquo;</span></a></h6>
            <div class="collapse" id="history-content">
                @foreach($history as $review)
                    @include('reviews.partial_teacher')
                @endforeach
            </div>
        @elseif(Auth::user()->type == 'student' && $review != null)
            @include('reviews.partial_student')
        @endif
    </div>

    @if(count($files) || Auth::user()->type == 'teacher')
        @include('files.partial_' . Auth::user()->type)
    @endif
    
</div>
@endsection