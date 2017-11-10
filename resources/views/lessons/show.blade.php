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
            @if($review != null)
                <div class="card my-spacing border-{{ $review->status()->context_class }}">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ ucfirst($review->wv_filename) }}</a>
                                <span class="badge badge-{{ $review->status()->context_class }}">WV</span>
                            </h5>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @if($review->tv_filename == null)
                                <a class="ml-3" href="/reviews/{{ $review->id }}/edit">(Trainersversie toevoegen)</a>
                                <span class="badge badge-danger">TV</span>
                            @else
                                <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/tv">{{ $review->tv_filename }}</a>
                                <span class="badge badge-{{ $review->status()->context_class }}">TV</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @if($review->sv_filename == null)
                                <a class="ml-3" href="/reviews/{{ $review->id }}/edit">(Studentversie toevoegen)</a>
                                <span class="badge badge-danger">SV</span>
                            @else
                                <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/sv">{{ $review->sv_filename }}</a>
                                <span class="badge badge-{{ $review->status()->context_class }}">SV</span>
                            @endif
                        </li>
                    </ul>
                    <div class="card-body">
                        @if($review->comment != null && $review->status()->title != 'Compleet')
                            <p>
                                <span class="text-muted">{{ $review->reviewer()->name }}: </span>
                                {{ $review->comment }}
                            </p>
                        @endif
                        <div class="btn-group review-buttons">
                            @if($review->status()->title == 'Concept' || $review->status()->title == 'In-review')
                                <a href="/reviews/{{ $review->id }}/review" class="card-link btn btn-outline-primary"><i class="fa fa-eye"></i> Reviewen</a>
                            @endif
                            <a href="/reviews/create?lesson={{ $lesson->id }}" class="card-link btn btn-outline-primary"><i class="fa fa-plus"></i> Bestand</a>
                            <a href="/reviews/addwiki?lesson={{ $lesson->id }}" class="card-link btn btn-outline-primary"><i class="fa fa-link"></i> Wiki-link</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $review->status()->title }} ({{ $review->created_at->diffForHumans() }} door {{ $review->author->name }})
                    </div>
                </div>
                
                <h6 class="my-spacing" id="history-title"><a data-toggle="collapse" class="collapsed" href="#history-content">Geschiedenis <span>&raquo;</span></a></h6>

                <div class="collapse" id="history-content">
                @foreach($history as $review)
                    <div class="card my-spacing border-{{ $review->status()->context_class }}">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ $review->wv_filename }}</a>
                                    <span class="badge badge-{{ $review->status()->context_class }}">WV</span>
                                </h5>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($review->tv_filename == null)
                                    <span>(Trainersversie ontbreekt)</span>
                                    <span class="badge badge-danger">TV</span>
                                @else
                                    <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/tv">{{ $review->tv_filename }}</a>
                                    <span class="badge badge-{{ $review->status()->context_class }}">TV</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($review->sv_filename == null)
                                    <span>(Studentversie ontbreekt)</span>
                                    <span class="badge badge-danger">SV</span>
                                @else
                                    <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/sv">{{ $review->sv_filename }}</a>
                                    <span class="badge badge-{{ $review->status()->context_class }}">SV</span>
                                @endif
                            </li>
                        </ul>
                        <div class="card-body">
                            @if($review->comment != null)
                                <p>
                                    <span class="text-muted">{{ $review->reviewer()->name }}: </span>
                                    {{ $review->comment }}
                                </p>
                            @endif
                        </div>
                        <div class="card-footer text-muted">
                            {{ $review->status()->title }} ({{ $review->created_at->diffForHumans() }} door {{ $review->author()->name }})
                        </div>
                    </div>
                @endforeach
                </div>

            @else
                <div class="card my-spacing border-danger">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span>&nbsp;</span>
                                <span class="badge badge-danger">WV</span>
                            </h5>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>&nbsp;</span>
                            <span class="badge badge-danger">TV</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>&nbsp;</span>
                            <span class="badge badge-danger">SV</span>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="/reviews/create?lesson={{ $lesson->id }}" class="card-link btn btn-outline-primary">Eerste versie uploaden</a>
                    </div>
                    <div class="card-footer text-muted">
                        Nieuw
                    </div>
                </div>
            @endif
        </div>

        <div class="col-6">
            <div class="card my-spacing">
                <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Losse bestanden</h5>
                    <a href="#" class="btn btn-outline-secondary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($files as $file)
                        <li class="list-group-item">
                            <a target="_blank" href="{{ $file->link }}" >
                                {{ $file->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
@endsection