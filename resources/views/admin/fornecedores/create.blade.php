@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Fornecedor
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fornecedores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="razao">{{ trans('cruds.fornecedore.fields.razao') }}</label>
                <input class="form-control {{ $errors->has('razao') ? 'is-invalid' : '' }}" type="text" name="razao" id="razao" value="{{ old('razao', '') }}">
                @if($errors->has('razao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('razao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.razao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nome">{{ trans('cruds.fornecedore.fields.nome') }}</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome" id="nome" value="{{ old('nome', '') }}" required>
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.nome_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cep">{{ trans('cruds.fornecedore.fields.cep') }}</label>
                <input class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" type="text" name="cep" id="cep" value="{{ old('cep', '') }}">
                @if($errors->has('cep'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cep') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.cep_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estado">{{ trans('cruds.fornecedore.fields.estado') }}</label>
                <select class="form-control" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Fornecedore::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.fornecedore.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.fornecedore.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.fornecedore.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.fornecedore.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero">{{ trans('cruds.fornecedore.fields.numero') }}</label>
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero" id="numero" value="{{ old('numero', '') }}">
                @if($errors->has('numero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.numero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="complemento">{{ trans('cruds.fornecedore.fields.complemento') }}</label>
                <input class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" type="text" name="complemento" id="complemento" value="{{ old('complemento', '') }}">
                @if($errors->has('complemento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('complemento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.complemento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rg">{{ trans('cruds.fornecedore.fields.rg') }}</label>
                <input class="form-control {{ $errors->has('rg') ? 'is-invalid' : '' }}" type="text" name="rg" id="rg" value="{{ old('rg', '') }}">
                @if($errors->has('rg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.rg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telefone_1">{{ trans('cruds.fornecedore.fields.telefone_1') }}</label>
                <input class="form-control {{ $errors->has('telefone_1') ? 'is-invalid' : '' }}" type="text" name="telefone_1" id="telefone_1" value="{{ old('telefone_1', '') }}">
                @if($errors->has('telefone_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefone_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.telefone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telefone_2">{{ trans('cruds.fornecedore.fields.telefone_2') }}</label>
                <input class="form-control {{ $errors->has('telefone_2') ? 'is-invalid' : '' }}" type="text" name="telefone_2" id="telefone_2" value="{{ old('telefone_2', '') }}">
                @if($errors->has('telefone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.telefone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato">{{ trans('cruds.fornecedore.fields.contato') }}</label>
                <input class="form-control {{ $errors->has('contato') ? 'is-invalid' : '' }}" type="text" name="contato" id="contato" value="{{ old('contato', '') }}">
                @if($errors->has('contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.contato_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="banco">{{ trans('cruds.fornecedore.fields.banco') }}</label>
                <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="banco" id="banco" value="{{ old('banco', '') }}">
                @if($errors->has('banco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.banco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agencia">{{ trans('cruds.fornecedore.fields.agencia') }}</label>
                <input class="form-control {{ $errors->has('agencia') ? 'is-invalid' : '' }}" type="text" name="agencia" id="agencia" value="{{ old('agencia', '') }}">
                @if($errors->has('agencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.agencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conta">{{ trans('cruds.fornecedore.fields.conta') }}</label>
                <input class="form-control {{ $errors->has('conta') ? 'is-invalid' : '' }}" type="text" name="conta" id="conta" value="{{ old('conta', '') }}">
                @if($errors->has('conta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.conta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.fornecedore.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="site">{{ trans('cruds.fornecedore.fields.site') }}</label>
                <input class="form-control {{ $errors->has('site') ? 'is-invalid' : '' }}" type="text" name="site" id="site" value="{{ old('site', '') }}">
                @if($errors->has('site'))
                    <div class="invalid-feedback">
                        {{ $errors->first('site') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.site_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observacoes">{{ trans('cruds.fornecedore.fields.observacoes') }}</label>
                <textarea class="form-control {{ $errors->has('observacoes') ? 'is-invalid' : '' }}" name="observacoes" id="observacoes">{{ old('observacoes') }}</textarea>
                @if($errors->has('observacoes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observacoes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.observacoes_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.fornecedore.fields.situacao') }}</label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Fornecedore::SITUACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fornecedore.fields.situacao_helper') }}</span>
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
