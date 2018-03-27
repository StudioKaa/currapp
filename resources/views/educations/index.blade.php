@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/educations/create">
        <i class="fa fa-plus" aria-hidden="true"></i> <span>Opleiding</span>
    </a>
@endsection

@section('content')

    <div class="card-container">
        @foreach ($educations as $education)
            <a class="link-card" href="/educations/{{ $education->title }}/now">
                <h4>{{ $education->title }}</h4>
                <p class="card-text">{{ $education->sub_title }}</p>
            </a>
        @endforeach
    </div>
    
@endsection