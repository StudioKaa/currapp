<?php 
use Carbon\Carbon;
Carbon::setLocale(config('app.locale'));
?>

@extends('layouts.app')

@section('buttons-student')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}">
        <i class="fa fa-chevron-up" aria-hidden="true"></i> Omhoog
    </a>
@endsection

@section('buttons-right')
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
            <span class="btn btn-outline-primary">{{ $revision == null ? 'Eerste' : 'Nieuwe' }} versie:</span>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/file" class="card-link btn btn-outline-primary"><i class="fa fa-file-text-o"></i> <span>bestand</span></a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/wiki" class="card-link btn btn-outline-primary"><i class="fa fa-link"></i> <span>wiki</span></a>
            <a href="/lessons/{{ $lesson->id }}/reviews/create/text" class="card-link btn btn-outline-primary"><i class="fa fa-font"></i> <span>tekst</span></a>
        </div>
    @endif

    <div class="revisions">
        @if($revision == null)
            <p>Voor deze les is (nog) geen reader beschikbaar.</p>
        @elseif(Auth::user()->type == 'teacher')
            @include('revisions.partial_teacher')
            <h6 class="my-spacing" id="history-title"><a data-toggle="collapse" class="collapsed" href="#history-content">Geschiedenis <span>&raquo;</span></a></h6>
            <div class="collapse" id="history-content">
                @foreach($history as $revision)
                    @include('revisions.partial_teacher')
                @endforeach
            </div>
        @elseif(Auth::user()->type == 'student')
            @include('revisions.partial_student')
        @endif
    </div>

    @if(count($lesson->assets) || Auth::user()->type == 'teacher')
        @include('assets.partial_' . Auth::user()->type)
    @endif
    
</div>
@endsection