@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.instalar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.instalars.update", [$instalar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ano">{{ trans('cruds.instalar.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $instalar->ano) }}" step="1">
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hierarquia_id">{{ trans('cruds.instalar.fields.hierarquia') }}</label>
                <select class="form-control select2 {{ $errors->has('hierarquia') ? 'is-invalid' : '' }}" name="hierarquia_id" id="hierarquia_id">
                    @foreach($hierarquias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('hierarquia_id') ? old('hierarquia_id') : $instalar->hierarquia->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hierarquia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hierarquia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.hierarquia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profissional_id">{{ trans('cruds.instalar.fields.profissional') }}</label>
                <select class="form-control select2 {{ $errors->has('profissional') ? 'is-invalid' : '' }}" name="profissional_id" id="profissional_id">
                    @foreach($profissionals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('profissional_id') ? old('profissional_id') : $instalar->profissional->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('profissional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.profissional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instituicao_id">{{ trans('cruds.instalar.fields.instituicao') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id">
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicao_id') ? old('instituicao_id') : $instalar->instituicao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.instituicao_helper') }}</span>
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