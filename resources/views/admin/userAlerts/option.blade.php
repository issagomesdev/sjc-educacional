@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Criar Comunicado
    </div>

    <div class="card-body">
      <form method="GET" action="{{ route("admin.user-alerts.create") }}">
            @csrf


            <div class="form-group">
                <label for="instituicaos">{{ trans('cruds.userAlert.fields.instituicao') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('instituicaos') ? 'is-invalid' : '' }}" name="instituicaos[]" id="instituicaos" multiple>
                    @foreach($instituicaos as $id => $instituicao)
                        <option value="{{ $id }}" {{ in_array($id, old('instituicaos', [])) ? 'selected' : '' }}>{{ $instituicao }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicaos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicaos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.instituicao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="grupos">{{ trans('cruds.userAlert.fields.grupo') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('grupos') ? 'is-invalid' : '' }}" name="grupos[]" id="grupos" multiple>
                    @foreach($grupos as $id => $grupo)
                        <option value="{{ $id }}" {{ in_array($id, old('grupos', [])) ? 'selected' : '' }}>{{ $grupo }}</option>
                    @endforeach
                </select>
                @if($errors->has('grupos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('grupos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.grupo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
          </div>
       </div>

@endsection
