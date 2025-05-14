@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Instalar Profissional
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.instalars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="ano">{{ trans('cruds.instalar.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', '') }}" step="1" required>
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instituicao_id">{{ trans('cruds.instalar.fields.instituicao') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id" required>
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ old('instituicao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="funcaos">{{ trans('cruds.instalar.fields.funcao') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('funcaos') ? 'is-invalid' : '' }}" name="funcaos[]" id="funcaos" multiple>
                    @foreach($funcaos as $id => $funcao)
                        <option value="{{ $id }}" {{ in_array($id, old('funcaos', [])) ? 'selected' : '' }}>{{ $funcao }}</option>
                    @endforeach
                </select>
                @if($errors->has('funcaos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('funcaos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.funcao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profissional_id">{{ trans('cruds.instalar.fields.profissional') }}</label>
                <select class="form-control select2 {{ $errors->has('profissional') ? 'is-invalid' : '' }}" name="profissional_id" id="profissional_id" required>
                    @foreach($profissionals as $id => $entry)
                        <option value="{{ $id }}" {{ old('profissional_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('profissional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalar.fields.profissional_helper') }}</span>
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
