@extends('layouts.app')

@section('page-title')
    > Opleiding verwijderen
@endsection

@section('content')
  
  <h3>Weet je het zeker?</h3>
  <p>Je staat op het punt de opleiding <strong>{{ $education->title }}</strong> te verwijderen.</p>
  
  <form method="POST" action="/educations/{{ $education->id }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">
      <i class="fa fa-trash-o" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection