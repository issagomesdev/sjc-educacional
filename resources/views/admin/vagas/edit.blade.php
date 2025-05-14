@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Vagas da Turma
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vagas.update", [$vaga->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="ano">Ano</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $vaga->ano) }}" step="1">
                <span class="help-block">{{ trans('cruds.vaga.fields.total_de_vadas_helper') }}</span>
            </div>
            @if($auth[0] == 2)
            <div class="form-group">
                <label for="escola_id">{{ trans('cruds.vaga.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id">
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('escola_id') ? old('escola_id') : $vaga->escola->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaga.fields.escola_helper') }}</span>
            </div>
            @endif
            <div class="form-group">
                <label for="turma_id">{{ trans('cruds.vaga.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id" required>
                  <option value=""> Selecione por favor </option>
                    @foreach($turmas as $tur)
                        <option value="{{ $tur->id }}" {{ (old('turma_id') ? old('turma_id') : $vaga->turma->id ?? '') == $tur->id ? 'selected' : '' }}> {{ $tur->serie ?? '' }} {{ $tur->identificacao ?? '' }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.vaga.fields.turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_de_vadas">{{ trans('cruds.vaga.fields.total_de_vadas') }}</label>
                <input class="form-control {{ $errors->has('total_de_vadas') ? 'is-invalid' : '' }}" type="number" name="total_de_vadas" id="total_de_vadas" value="{{ old('total_de_vadas', $vaga->total_de_vadas) }}" step="1">
                @if($errors->has('total_de_vadas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_de_vadas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaga.fields.total_de_vadas_helper') }}</span>
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
