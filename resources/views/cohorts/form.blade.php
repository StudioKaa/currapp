@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> Annuleren
    </a>
@endsection

@section('content')
  
  @if($cohort->exists)
    <form method="POST" action="/cohorts/{{ $cohort->id }}">
    {{ method_field('PATCH') }}
  @else
    <form method="POST" action="/cohorts">
  @endif

  @include('layouts/errors')

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Opleiding</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" value="{{ $education->title }}">
      <input type="hidden" name="education" value="{{ $education->id }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Start-jaar</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="start_year" value="{{ old('start_year', $cohort->start_year) }}">
    </div>
  </div>
  @if(!$cohort->exists)
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Periodes aanmaken</label>
      <div class="col-sm-10">
        <input type="checkbox" name="create_terms" value="yes" checked>
         <small class="form-text text-muted">Maakt in dit cohort vast alle periodes aan.</small>
      </div>
    </div>
  @endif

  {{ csrf_field() }}

  <button type="submit" class="btn btn-success">
    <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
  </button>
	

  @if($cohort->exists)
    <a class="btn btn-danger" href="/cohorts/{{ $cohort->id }}/delete">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Verwijderen
    </a>
  @endif

  </form>
    
@endsection