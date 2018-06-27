@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
    <form method="POST" action="{{ route('revisions.store.wiki', $lesson) }}">

    	@include('layouts/errors')

      
	  	<div class="form-group row">
    		<label class="col-sm-2 col-form-label">Les</label>
    		<div class="col-sm-10">
	    		<input type="text" readonly class="form-control-plaintext" value="{{ $lesson_type->title }}: {{ $lesson->title }}">
	    		<input type="hidden" name="lesson" value="{{ $lesson->id }}">
	    	</div>
  		</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Link naar wiki:</label>
        <div class="col-sm-10">
          <div class="input-group">
            <span class="input-group-addon">https://wiki.amo.rocks/wiki/</span>
            <input type="text" class="form-control" name="wiki">
          </div>
        </div>
      </div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-success">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
      </button>

	</form>

@endsection