@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.deslocar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.deslocars.update", [$deslocar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="ano">{{ trans('cruds.deslocar.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $deslocar->ano) }}" step="1" required>
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instituicao_anterior_id">{{ trans('cruds.deslocar.fields.instituicao_anterior') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao_anterior') ? 'is-invalid' : '' }}" name="instituicao_anterior_id" id="instituicao_anterior_id" required>
                    @foreach($instituicao_anteriors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicao_anterior_id') ? old('instituicao_anterior_id') : $deslocar->instituicao_anterior->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao_anterior'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao_anterior') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.instituicao_anterior_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hierarquia_id">{{ trans('cruds.deslocar.fields.hierarquia') }}</label>
                <select class="form-control select2 {{ $errors->has('hierarquia') ? 'is-invalid' : '' }}" name="hierarquia_id" id="hierarquia_id" required>
                    @foreach($hierarquias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('hierarquia_id') ? old('hierarquia_id') : $deslocar->hierarquia->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hierarquia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hierarquia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.hierarquia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profissional_id">{{ trans('cruds.deslocar.fields.profissional') }}</label>
                <select class="form-control select2 {{ $errors->has('profissional') ? 'is-invalid' : '' }}" name="profissional_id" id="profissional_id" required>
                    @foreach($profissionals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('profissional_id') ? old('profissional_id') : $deslocar->profissional->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('profissional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.profissional_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instituicao_id">{{ trans('cruds.deslocar.fields.instituicao') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id" required>
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicao_id') ? old('instituicao_id') : $deslocar->instituicao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.instituicao_helper') }}</span>
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