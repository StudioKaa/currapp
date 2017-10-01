@extends('layouts.app')

@section('page-title')
    > Inloggen
@endsection

@section('content')


    <form method="POST" action="{{ route('login') }}">

        @include('layouts/errors')

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
            <div class="col-sm-10">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Wachtwoord</label>
            <div class="col-sm-10">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Blijf ingelogd
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a class="btn btn-outline-primary" href="{{ route('password.request') }}">
                    Wachtwoord vergeten?
                </a>
            </div>
        </div>

        {{ csrf_field() }}
    </form>

@endsection
