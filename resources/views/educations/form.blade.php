@extends('layouts.app')

@section('page-title')
    > {{ $education->exists ? 'Opleiding aanpassen' : 'Nieuwe opleiding' }}
@endsection

@section('buttons-right')
    <?php $href = $education->exists ? '/educations/' . $education->id : '/educations'; ?>
    <a class="btn btn-outline-secondary navbar-text" href="{{ $href }}">
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