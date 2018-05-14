@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    <form method="POST" action="/reviews/{{ $review->id }}/addfiles" enctype="multipart/form-data">
      {{ method_field('PATCH') }}

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
        </div>
      </div>
	  	<div class="form-group row">
    		<label class="col-sm-2 col-form-label">Periode</label>
    		<div class="col-sm-10">
	    		<input type="text" readonly class="form-control-plaintext" value="{{ $term->title }}">
	    	</div>
  		</div>
	  	<div class="form-group row">
    		<label class="col-sm-2 col-form-label">Les</label>
    		<div class="col-sm-10">
	    		<input type="text" readonly class="form-control-plaintext" value="{{ $lesson_type->title }}: {{ $lesson->title }}">
	    	</div>
  		</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Werkversie</label>
        <div class="col-sm-10">
          <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ $review->wv_filename }}</a>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Trainersversie</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="tv_file">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Studentenversie</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="sv_file">
        </div>
      </div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-success">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
      </button>

	</form>

@endsection