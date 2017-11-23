@extends('layouts.app')

@section('breadcrumbs')
    <ol class="my-breadcrumb navbar-text">
        <li class="breadcrumb-item">
            <a href="/educations/{{ $cohort->education->id }}">{{ $cohort->education->title }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ $cohort->title }}
            <!-- <select class="cohort-select" id="to-cohort">
                @foreach($cohort->education->cohorts as $c)
                    <option value="{{ $c->id }}" <?php echo $c->id == $cohort->id ? 'selected' : '' ?>>
                        {{ $c->start_year }} - {{ $c->exam_year }}
                    </option>
                @endforeach
            </select> -->
        </li>
    </ol>
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/create?cohort={{ $cohort->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> Periode
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/{{ $cohort->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $cohort->start_year }} - {{ $cohort->exam_year }}
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/cohort.css') }}">
@endpush

@section('content')

    <div class="cohort-grid" style="grid-template-columns: repeat({{ $education->terms_per_year }}, 1fr);">
        @foreach ($terms as $term)
            <a class="link-card" href="{{ url('terms', [$term->id]) }}"
                style="grid-column: {{ $term->order_in_year }} / span {{ $term->duration }};">
                <h4>{{ $term->title }}</h4>
                <p class="card-text">{{ $term->sub_title }}</p>
            </a>
        @endforeach
    </div>
    
@endsection