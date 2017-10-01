@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/educations/create">
        <i class="fa fa-plus" aria-hidden="true"></i> Opleiding
    </a>
@endsection

@section('content')

    <div class="card-deck">
        @foreach ($educations as $edu)
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3 class="card-title">{{ $edu->title }}</h3>
                    <p class="card-text">{{ $edu->description }}</p>
                    <a class="btn btn-outline-primary" href="{{ url('educations', [$edu->id]) }}">Ga naar {{ $edu->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection