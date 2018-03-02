<?php 
use Carbon\Carbon;
Carbon::setLocale(config('app.locale')); ?>

@extends('layouts.app')

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
        <i class="fa fa-chevron-left" aria-hidden="true"></i> <span>Overzicht</span>
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/lessons/{{ $lesson->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> <span>{{ $lesson->title }}</span>
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/lesson.css') }}">
@endpush

@section('content')
    
<div class="lesson-container">

    <h3>{{ $lesson_type->title }}: {{ $lesson->title }}</h3>

    @if(Auth::user()->type == 'teacher')
        <div class="btn-group review-buttons">
            <span class="btn btn-outline-primary">{{ $review == null ? 'Eerste' : 'Nieuwe' }} versie:</span>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/file" class="card-link btn btn-outline-primary"><i class="fa fa-file-text-o"></i> <span>bestand</span></a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/wiki" class="card-link btn btn-outline-primary"><i class="fa fa-link"></i> <span>wiki</span></a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/text" class="card-link btn btn-outline-primary"><i class="fa fa-font"></i> <span>tekst</span></a>
        </div>
    @endif

    <div class="reviews">
        @if($review == null || ($review->type == \App\Review::TYPE_TEXT && Auth::user()->type == 'student'))
            <p><em>Voor deze les is geen reader beschikbaar.</em></p>
        @else
            @if($review->type == \App\Review::TYPE_TEXT && Auth::user()->type == 'teacher')
                <pre>{{ $review->comment }}</pre>
            @elseif(Auth::user()->type == 'teacher')
                @include('reviews.partial_teacher')
                <h6 class="my-spacing" id="history-title"><a data-toggle="collapse" class="collapsed" href="#history-content">Geschiedenis <span>&raquo;</span></a></h6>
                <div class="collapse" id="history-content">
                    @foreach($history as $review)
                        @include('reviews.partial_teacher')
                    @endforeach
                </div>
            @elseif(Auth::user()->type == 'student')
                @include('reviews.partial_student')
            @endif
        @endif
    </div>

    @if(count($lesson->assets) || Auth::user()->type == 'teacher')
        @include('assets.partial_' . Auth::user()->type)
    @endif
    
</div>
@endsection