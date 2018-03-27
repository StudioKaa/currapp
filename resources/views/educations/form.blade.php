@extends('layouts.app')

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="{{ URL::previous() }}">
        <i class="fa fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($education->exists)
        <form method="POST" action="/educations/{{ $education->id }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="/educations">
    @endif

        @include('layouts/errors')

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                @if($education->exists)
                    <input type="text" readonly="" class="form-control-plaintext" name="title" value="{{ $education->title }}">
                @else
                    <input type="text" class="form-control" name="title" value="{{ old('title', $education->title) }}">
                @endif
                <small class="form-text text-muted">Titel kan later niet worden aangepast, de sub-titel wel.</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sub-titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', $education->sub_title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Duur in jaren</label>
            <div class="col-sm-10">
                @if($education->exists)
                    <input type="text" readonly class="form-control-plaintext" name="duration" value="{{ $education->duration }}">
                @else
                    <input type="text" class="form-control" name="duration" value="3">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Periodes per jaar</label>
            <div class="col-sm-10">
                @if($education->exists)
                    <input type="text" readonly class="form-control-plaintext" name="terms_per_year" value="{{ $education->terms_per_year }}">
                @else
                    <input type="text" class="form-control" name="terms_per_year" value="4">
                @endif
            </div>
        </div>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
        </button>


        @if($education->exists)
        <a class="btn btn-danger" href="/educations/{{ $education->id }}/delete">
            <i class="fa fa-trash-o" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection