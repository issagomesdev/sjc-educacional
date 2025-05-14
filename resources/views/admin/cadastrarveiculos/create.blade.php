@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Veículo
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cadastrarveiculos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="niv">{{ trans('cruds.cadastrarveiculo.fields.niv') }}</label>
                <input class="form-control {{ $errors->has('niv') ? 'is-invalid' : '' }}" type="text" name="niv" id="niv" value="{{ old('niv', '') }}">
                @if($errors->has('niv'))
                    <div class="invalid-feedback">
                        {{ $errors->first('niv') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.niv_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="placa">{{ trans('cruds.cadastrarveiculo.fields.placa') }}</label>
                <input class="form-control {{ $errors->has('placa') ? 'is-invalid' : '' }}" type="text" name="placa" id="placa" value="{{ old('placa', '') }}">
                @if($errors->has('placa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('placa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.placa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="renavam">{{ trans('cruds.cadastrarveiculo.fields.renavam') }}</label>
                <input class="form-control {{ $errors->has('renavam') ? 'is-invalid' : '' }}" type="text" name="renavam" id="renavam" value="{{ old('renavam', '') }}">
                @if($errors->has('renavam'))
                    <div class="invalid-feedback">
                        {{ $errors->first('renavam') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.renavam_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marca">{{ trans('cruds.cadastrarveiculo.fields.marca') }}</label>
                <input class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}" type="text" name="marca" id="marca" value="{{ old('marca', '') }}">
                @if($errors->has('marca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.marca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.cadastrarveiculo.fields.descricao') }}</label>
                <input class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" id="descricao" value="{{ old('descricao', '') }}">
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instituicao_id">{{ trans('cruds.cadastrarveiculo.fields.instituicao') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id">
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ old('instituicao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.instituicao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="motorista_responsavels">{{ trans('cruds.cadastrarveiculo.fields.motorista_responsavel') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('motorista_responsavels') ? 'is-invalid' : '' }}" name="motorista_responsavels[]" id="motorista_responsavels" multiple>
                    @foreach($motorista_responsavels as $id => $motorista_responsavel)
                        <option value="{{ $id }}" {{ in_array($id, old('motorista_responsavels', [])) ? 'selected' : '' }}>{{ $motorista_responsavel }}</option>
                    @endforeach
                </select>
                @if($errors->has('motorista_responsavels'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motorista_responsavels') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.motorista_responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarveiculo.fields.situacao') }}</label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cadastrarveiculo::SITUACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarveiculo.fields.situacao_helper') }}</span>
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
