@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/educations/create">
        <i class="fa fa-plus" aria-hidden="true"></i> Opleiding
    </a>
@endsection

@section('content')

    <div class="card-container">
        @foreach ($educations as $education)
            <a class="link-card" href="{{ url('educations', [$education->id]) }}">
                <h4>{{ $education->title }}</h4>
                <p class="card-text">{{ $education->description }}</p>
            </a>
        @endforeach
    </div>
    
@endsection