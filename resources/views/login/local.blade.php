@extends('layouts.app')

@section('page-title')
    > Local login
@endsection

@section('content')
    
    <p>Login:</p>
    <form action="/login" method="POST">
    	{{ csrf_field() }}
		<input type="text" name="id" placeholder="User ID">
		<input type="submit">
    </form>

@endsection