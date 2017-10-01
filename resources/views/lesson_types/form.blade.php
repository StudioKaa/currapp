@extends('layouts.app')

@section('page-title')
    > <a class="navbar-text" href="/educations/{{ $education->id }}">{{ $education->title }}</a>
    > <a class="navbar-text" href="/cohorts/{{ $cohort->id }}">{{ $cohort->start_year }} - {{ $cohort->exam_year }}</a>
    > <a class="navbar-text" href="/terms/{{ $term->id }}">{{ $term->title }}</a>
    > {{ $lesson_type->exists ? 'Lesvorm aanpassen' : 'Nieuwe lesvorm' }}
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}">
        <i class="fa fa-times" aria-hidden="true"></i> Annuleren
    </a>
@endsection

@section('content')
  
  @if($lesson_type->exists)
    <form method="POST" action="/lesson_types/{{ $lesson_type->id }}">
    {{ method_field('PATCH') }}
  @else
    <form method="POST" action="/lesson_types">
  @endif

  @include('layouts/errors')

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Opleiding</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" value="{{ $education->title }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Cohort</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" value="{{ $cohort->start_year }} - {{ $cohort->exam_year }}">
      <input type="hidden" name="cohort" value="{{ $cohort->id }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Periode</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" value="{{ $term->title }}">
      <input type="hidden" name="term" value="{{ $term->id }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Titel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" value="{{ old('title', $lesson_type->title) }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Sub-titel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', $lesson_type->sub_title) }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Volgorde</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="order" value="{{ old('order', $lesson_type->order) }}">
    </div>
  </div>

  {{ csrf_field() }}

  <button type="submit" class="btn btn-success">
    <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
  </button>
	

  @if($lesson_type->exists)
    <a class="btn btn-danger" href="/lesson_types/{{ $lesson_type->id }}/delete">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Verwijderen
    </a>
  @endif

  </form>
    
@endsection