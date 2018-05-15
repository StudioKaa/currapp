@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h3>Weet je het zeker?</h3>
  <p>Je staat op het punt de periode <strong>{{ $term->cohort->education->title }} > {{ $term->cohort->start_year }} - {{ $term->cohort->exam_year }} > {{ $term->title }}</strong> te verwijderen.</p>
  
  <form method="POST" action="/terms/{{ $term->id }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection