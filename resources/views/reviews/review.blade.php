@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    <form method="POST" action="/reviews/{{ $review->id }}/review">
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
        <label class="col-sm-2 col-form-label">Ontwikkelaar</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="{{ $review->author->name }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Resonant</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="{{ $review->reviewer->name }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Werkversie</label>
        <div class="col-sm-10">
          <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ $review->wv_filename }}</a>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nieuwe status</label>
        <div class="col-sm-10">
          <div class="btn-group" data-toggle="buttons">
            @foreach($statuses as $status)
            <label class="btn btn-outline-primary" for="status{{ $status->id }}">
              <input class="form-check-input" type="radio" name="review_status_id" id="status{{ $status->id }}" value="{{ $status->id }}">
              {{ $status->title }}
             </label>
          @endforeach
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Commentaar</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="comment">{{ old('comment') }}</textarea>
          <small class="form-text text-muted">Leeg laten indien compleet.</small>
        </div>
      </div>

  		{{ csrf_field() }}

  		<button type="submit" class="btn btn-success">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
      </button>

	</form>

@endsection