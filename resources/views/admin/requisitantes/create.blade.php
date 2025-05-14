@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Requisitante
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.requisitantes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome">{{ trans('cruds.requisitante.fields.nome') }}</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome" id="nome" value="{{ old('nome', '') }}" required>
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.nome_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.requisitante.fields.descricao') }}</label>
                <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{{ old('descricao') }}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cep">{{ trans('cruds.requisitante.fields.cep') }}</label>
                <input class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" type="text" name="cep" id="cep" value="{{ old('cep', '') }}">
                @if($errors->has('cep'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cep') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.cep_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.requisitante.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Requisitante::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.requisitante.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.requisitante.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.requisitante.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero">{{ trans('cruds.requisitante.fields.numero') }}</label>
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero" id="numero" value="{{ old('numero', '') }}">
                @if($errors->has('numero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.numero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estoques">{{ trans('cruds.requisitante.fields.estoques') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('estoques') ? 'is-invalid' : '' }}" name="estoques[]" id="estoques" multiple>
                    @foreach($estoques as $id => $estoque)
                        <option value="{{ $id }}" {{ in_array($id, old('estoques', [])) ? 'selected' : '' }}>{{ $estoque }}</option>
                    @endforeach
                </select>
                @if($errors->has('estoques'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estoques') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.estoques_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.requisitante.fields.situacao') }}</label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Requisitante::SITUACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requisitante.fields.situacao_helper') }}</span>
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
