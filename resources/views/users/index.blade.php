@extends('layouts.app')

@section('page-title')
    > Gebruikers
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/register">
        <i class="fa fa-plus" aria-hidden="true"></i> Gebruiker
    </a>
@endsection

@section('content')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection