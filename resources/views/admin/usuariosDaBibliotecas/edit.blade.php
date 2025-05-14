@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Usuário Da Biblioteca
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.usuarios-da-bibliotecas.update", [$usuariosDaBiblioteca->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nome_completo">{{ trans('cruds.usuariosDaBiblioteca.fields.nome_completo') }}</label>
                <input class="form-control {{ $errors->has('nome_completo') ? 'is-invalid' : '' }}" type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo', $usuariosDaBiblioteca->nome_completo) }}">
                @if($errors->has('nome_completo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_completo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.nome_completo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_de_nascimento">{{ trans('cruds.usuariosDaBiblioteca.fields.data_de_nascimento') }}</label>
                <input class="form-control" type="date" name="data_de_nascimento" id="data_de_nascimento" value="{{ old('data_de_nascimento', $usuariosDaBiblioteca->data_de_nascimento) }}">
                @if($errors->has('data_de_nascimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_de_nascimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.data_de_nascimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.usuariosDaBiblioteca.fields.genero') }}</label>
                @foreach(App\Models\UsuariosDaBiblioteca::GENERO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('genero') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="genero_{{ $key }}" name="genero" value="{{ $key }}" {{ old('genero', $usuariosDaBiblioteca->genero) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="genero_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.genero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nacionalidade">{{ trans('cruds.usuariosDaBiblioteca.fields.nacionalidade') }}</label>
                <input class="form-control {{ $errors->has('nacionalidade') ? 'is-invalid' : '' }}" type="text" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade', $usuariosDaBiblioteca->nacionalidade) }}">
                @if($errors->has('nacionalidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nacionalidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.nacionalidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.usuariosDaBiblioteca.fields.localizacao') }}</label>
                @foreach(App\Models\UsuariosDaBiblioteca::LOCALIZACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('localizacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="localizacao_{{ $key }}" name="localizacao" value="{{ $key }}" {{ old('localizacao', $usuariosDaBiblioteca->localizacao) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="localizacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.usuariosDaBiblioteca.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UsuariosDaBiblioteca::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', $usuariosDaBiblioteca->estado) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.usuariosDaBiblioteca.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', $usuariosDaBiblioteca->cidade) }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.usuariosDaBiblioteca.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', $usuariosDaBiblioteca->bairro) }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.usuariosDaBiblioteca.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', $usuariosDaBiblioteca->endereco) }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_mail_de_contato">{{ trans('cruds.usuariosDaBiblioteca.fields.e_mail_de_contato') }}</label>
                <input class="form-control {{ $errors->has('e_mail_de_contato') ? 'is-invalid' : '' }}" type="text" name="e_mail_de_contato" id="e_mail_de_contato" value="{{ old('e_mail_de_contato', $usuariosDaBiblioteca->e_mail_de_contato) }}">
                @if($errors->has('e_mail_de_contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_mail_de_contato') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.e_mail_de_contato_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_do_cpf">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_do_cpf') }}</label>
                <input class="form-control {{ $errors->has('numero_do_cpf') ? 'is-invalid' : '' }}" type="text" name="numero_do_cpf" id="numero_do_cpf" value="{{ old('numero_do_cpf', $usuariosDaBiblioteca->numero_do_cpf) }}">
                @if($errors->has('numero_do_cpf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_do_cpf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_do_cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_da_identidade">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_da_identidade') }}</label>
                <input class="form-control {{ $errors->has('numero_da_identidade') ? 'is-invalid' : '' }}" type="text" name="numero_da_identidade" id="numero_da_identidade" value="{{ old('numero_da_identidade', $usuariosDaBiblioteca->numero_da_identidade) }}">
                @if($errors->has('numero_da_identidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_da_identidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_da_identidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_de_telefone">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_de_telefone') }}</label>
                <input class="form-control {{ $errors->has('numero_de_telefone') ? 'is-invalid' : '' }}" type="text" name="numero_de_telefone" id="numero_de_telefone" value="{{ old('numero_de_telefone', $usuariosDaBiblioteca->numero_de_telefone) }}">
                @if($errors->has('numero_de_telefone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_de_telefone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usuariosDaBiblioteca.fields.numero_de_telefone_helper') }}</span>
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
