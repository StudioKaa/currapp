@extends('layouts.app')

@section('content')
  
    <form method="POST" action="/files/{{ $file->id }}" enctype="multipart/form-data">
      {{ method_field('DELETE') }}

    	@include('layouts/errors')

	  	<div class="form-group row">
    		<label class="col-sm-2 col-form-label">Bestand</label>
    		<div class="col-sm-10">
	    		<input type="text" readonly class="form-control-plaintext" value="{{ $file->title }}">
	    		<input type="hidden" name="file" value="{{ $file->id }}">
	    	</div>
  		</div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i> Verwijderen
      </button>

	</form>

@endsection