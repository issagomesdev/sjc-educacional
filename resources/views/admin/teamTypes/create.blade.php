@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.teamType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.team-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="titulo">{{ trans('cruds.teamType.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamType.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sobre">{{ trans('cruds.teamType.fields.sobre') }}</label>
                <input class="form-control {{ $errors->has('sobre') ? 'is-invalid' : '' }}" type="text" name="sobre" id="sobre" value="{{ old('sobre', '') }}">
                @if($errors->has('sobre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sobre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamType.fields.sobre_helper') }}</span>
            </div>
               <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
               <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
