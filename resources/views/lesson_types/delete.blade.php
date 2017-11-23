@extends('layouts.app')

@section('content')
  
  <h3>Weet je het zeker?</h3>
  <p>Je staat op het punt de lesvorm <strong>{{ $lesson_type->term->cohort->education->title }} > {{ $lesson_type->term->cohort->start_year }} - {{ $lesson_type->term->cohort->exam_year }} > {{ $lesson_type->term->title }} > {{ $lesson_type->title }}</strong> te verwijderen.</p>
  
  <form method="POST" action="/lesson_types/{{ $lesson_type->id }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection