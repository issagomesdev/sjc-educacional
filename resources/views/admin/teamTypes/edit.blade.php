@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.teamType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.team-types.update", [$teamType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="titulo">{{ trans('cruds.teamType.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $teamType->titulo) }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamType.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sobre">{{ trans('cruds.teamType.fields.sobre') }}</label>
                <input class="form-control {{ $errors->has('sobre') ? 'is-invalid' : '' }}" type="text" name="sobre" id="sobre" value="{{ old('sobre', $teamType->sobre) }}">
                @if($errors->has('sobre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sobre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamType.fields.sobre_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection