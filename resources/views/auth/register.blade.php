@extends('layouts.app')

@section('page-title')
    > Nieuwe gebruiker
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/users">
        <i class="fa fa-times" aria-hidden="true"></i> Annuleren
    </a>
@endsection

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @include('layouts/errors')

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Naam</label>
            <div class="col-sm-10">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
            <div class="col-sm-10">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Wachtwoord</label>
            <div class="col-sm-10">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation" class="col-sm-2 col-form-label">Wachtwoord (check)</label>
            <div class="col-sm-10">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">
                    Registeren
                </button>
            </div>
        </div>

        {{ csrf_field() }}
    </form>
@endsection
