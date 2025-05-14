@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Criar Vagas
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vagas.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="ano">Ano</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', '') }}" step="1" required>
                <span class="help-block">{{ trans('cruds.vaga.fields.total_de_vadas_helper') }}</span>
            </div>
            @if($auth[0] == 2)
            <div class="form-group">
                <label for="escola_id">{{ trans('cruds.vaga.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id">
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ old('escola_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.vaga.fields.escola_helper') }}</span>
            </div>
            @else
            <input type="hidden" class="escola_id" value="{{Auth::user()->team_id}}" for="escola_id" name="escola_id">
            @endif
            <div class="form-group">
                <label for="turma_id">{{ trans('cruds.vaga.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id" required>
                  <option value=""> Selecione por favor </option>
                    @foreach($turmas as $tur)
                        <option value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}> {{ $tur->serie ?? '' }} {{ $tur->identificacao ?? '' }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaga.fields.turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_de_vadas">{{ trans('cruds.vaga.fields.total_de_vadas') }}</label>
                <input class="form-control {{ $errors->has('total_de_vadas') ? 'is-invalid' : '' }}" type="number" name="total_de_vadas" id="total_de_vadas" value="{{ old('total_de_vadas', '') }}" step="1" required>
                @if($errors->has('total_de_vadas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_de_vadas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaga.fields.total_de_vadas_helper') }}</span>
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
