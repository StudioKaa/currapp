@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/lessons/{{ $lesson->id }}">
        <i class="fa fa-times" aria-hidden="true"></i> Annuleren
    </a>
@endsection

@section('content')
  
    <form method="POST" action="/reviews" enctype="multipart/form-data">

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
	    		<input type="hidden" name="lesson" value="{{ $lesson->id }}">
	    	</div>
  		</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Ontwikkelaar</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="{{ $review->author->name }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Resonant</label>
        <div class="col-sm-10">
          <select class="form-control" name="reviewer_id">
            <option value="-1">geen (opslaan als concept)</option>
            <option value="0">geen (forceer compleet)</option>
            @foreach($users as $user):
              <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
      </div>


      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Werkversie</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="wv_file">
          <small class="form-text text-muted">Verplicht.</small>
        </div>
      </div>
	  	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Trainersversie</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="tv_file">
          <small class="form-text text-muted">Optioneel, kan ook later toegevoegd worden.</small>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Studentenversie</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="sv_file">
          <small class="form-text text-muted">Optioneel, kan ook later toegevoegd worden.</small>
        </div>
      </div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-success">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
      </button>

	</form>

@endsection