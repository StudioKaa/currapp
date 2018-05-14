@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
    <form method="POST" action="{{ route('lessons.assets.destroy', [$asset->lesson, $asset]) }}">
      {{ method_field('DELETE') }}

    	@include('layouts/errors')
  
      <h3>Weet je het zeker?</h3>
	  	<div class="form-group row">
    		<label class="col-sm-2 col-form-label">Asset:</label>
    		<div class="col-sm-10">
	    		<input type="text" readonly class="form-control-plaintext" value="{{ $asset->title }}">
	    		<input type="hidden" name="asset" value="{{ $asset->id }}">
	    	</div>
  		</div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i> Verwijderen
      </button>

	</form>

@endsection