@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> Annuleren
    </a>
@endsection

@section('content')
  
  @if($education->exists)
    <form method="POST" action="/educations/{{ $education->id }}">
    {{ method_field('PATCH') }}
  @else
    <form method="POST" action="/educations">
  @endif

  @include('layouts/errors')

  <div class="form-group row">
  	<label class="col-sm-2 col-form-label">Titel</label>
  	<div class="col-sm-10">
  		<input type="text" class="form-control" name="title" value="{{ old('title', $education->title) }}">
  	</div>
  </div>
  @if(!$education->exists)
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Duur in jaren</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="duration" value="3">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Periodes per jaar</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="terms_per_year" value="4">
      </div>
    </div>
  @endif

  {{ csrf_field() }}

  <button type="submit" class="btn btn-success">
    <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
  </button>
	

  @if($education->exists)
    <a class="btn btn-danger" href="/educations/{{ $education->id }}/delete">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Verwijderen
    </a>
  @endif

  </form>
    
@endsection