@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Aluno
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cadastros.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="foto_do_aluno">{{ trans('cruds.cadastro.fields.foto_do_aluno') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto_do_aluno') ? 'is-invalid' : '' }}" id="foto_do_aluno-dropzone">
                </div>
                @if($errors->has('foto_do_aluno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foto_do_aluno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.foto_do_aluno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nome_completo">{{ trans('cruds.cadastro.fields.nome_completo') }}</label>
                <input class="form-control" type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo', '') }}">
                <span class="help-block">{{ trans('cruds.cadastro.fields.nome_completo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="codigo_do_inep"> Código INEP </label>
                <input class="form-control" type="number" name="codigo_do_inep" id="codigo_do_inep" value="{{ old('codigo_do_inep', '') }}">
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="data_de_nascimento">{{ trans('cruds.cadastro.fields.data_de_nascimento') }} / Ano</label>
                <div class="group">
                <input class="form-control date {{ $errors->has('data_de_nascimento') ? 'is-invalid' : '' }}" type="text" name="data_de_nascimento" id="data_de_nascimento" value="{{ old('data_de_nascimento') }}">
                <input class="control" type="number" name="ano_de_nascimento" id="ano_de_nascimento" value="{{ old('ano_de_nascimento') }}">
                </div>
                @if($errors->has('data_de_nascimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_de_nascimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.data_de_nascimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.genero') }}</label>
                @foreach(App\Models\Cadastro::GENERO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('genero') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="genero_{{ $key }}" name="genero" value="{{ $key }}" {{ old('genero', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="genero_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.genero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nacionalidade">{{ trans('cruds.cadastro.fields.nacionalidade') }}</label>
                <input class="form-control {{ $errors->has('nacionalidade') ? 'is-invalid' : '' }}" type="text" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade', '') }}">
                @if($errors->has('nacionalidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nacionalidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.nacionalidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.localizacao') }}</label>
                @foreach(App\Models\Cadastro::LOCALIZACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('localizacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="localizacao_{{ $key }}" name="localizacao" value="{{ $key }}" {{ old('localizacao', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="localizacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cadastro::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.cadastro.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.cadastro.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.cadastro.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_do_aluno_id">E-mail de usuário do aluno</label>
                <select class="form-control select2 {{ $errors->has('email_do_aluno') ? 'is-invalid' : '' }}" name="email_do_aluno_id" id="email_do_aluno_id">
                    @foreach($email_do_alunos as $id => $entry)
                        <option value="{{ $id }}" {{ old('email_do_aluno_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('email_do_aluno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_do_aluno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.email_do_aluno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_mail_de_contato">{{ trans('cruds.cadastro.fields.e_mail_de_contato') }}</label>
                <input class="form-control {{ $errors->has('e_mail_de_contato') ? 'is-invalid' : '' }}" type="text" name="e_mail_de_contato" id="e_mail_de_contato" value="{{ old('e_mail_de_contato', '') }}">
                @if($errors->has('e_mail_de_contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_mail_de_contato') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.e_mail_de_contato_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="certidao_de_nascimento">{{ trans('cruds.cadastro.fields.certidao_de_nascimento') }}</label>
                <input class="form-control {{ $errors->has('certidao_de_nascimento') ? 'is-invalid' : '' }}" type="text" name="certidao_de_nascimento" id="certidao_de_nascimento" value="{{ old('certidao_de_nascimento', '') }}">
                @if($errors->has('certidao_de_nascimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certidao_de_nascimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.certidao_de_nascimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_do_nis">{{ trans('cruds.cadastro.fields.numero_do_nis') }}</label>
                <input class="form-control {{ $errors->has('numero_do_nis') ? 'is-invalid' : '' }}" type="text" name="numero_do_nis" id="numero_do_nis" value="{{ old('numero_do_nis', '') }}">
                @if($errors->has('numero_do_nis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_do_nis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.numero_do_nis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_do_cpf">{{ trans('cruds.cadastro.fields.numero_do_cpf') }}</label>
                <input class="form-control {{ $errors->has('numero_do_cpf') ? 'is-invalid' : '' }}" type="text" name="numero_do_cpf" id="numero_do_cpf" value="{{ old('numero_do_cpf', '') }}">
                @if($errors->has('numero_do_cpf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_do_cpf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.numero_do_cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_da_identidade">{{ trans('cruds.cadastro.fields.numero_da_identidade') }}</label>
                <input class="form-control {{ $errors->has('numero_da_identidade') ? 'is-invalid' : '' }}" type="text" name="numero_da_identidade" id="numero_da_identidade" value="{{ old('numero_da_identidade', '') }}">
                @if($errors->has('numero_da_identidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_da_identidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.numero_da_identidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_de_telefone">{{ trans('cruds.cadastro.fields.numero_de_telefone') }}</label>
                <input class="form-control {{ $errors->has('numero_de_telefone') ? 'is-invalid' : '' }}" type="text" name="numero_de_telefone" id="numero_de_telefone" value="{{ old('numero_de_telefone', '') }}">
                @if($errors->has('numero_de_telefone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_de_telefone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.numero_de_telefone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ocupacao_do_aluno">{{ trans('cruds.cadastro.fields.ocupacao_do_aluno') }}</label>
                <input class="form-control {{ $errors->has('ocupacao_do_aluno') ? 'is-invalid' : '' }}" type="text" name="ocupacao_do_aluno" id="ocupacao_do_aluno" value="{{ old('ocupacao_do_aluno', '') }}">
                @if($errors->has('ocupacao_do_aluno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ocupacao_do_aluno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.ocupacao_do_aluno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nome_responsavel">{{ trans('cruds.cadastro.fields.nome_responsavel') }}</label>
                <input class="form-control {{ $errors->has('nome_responsavel') ? 'is-invalid' : '' }}" type="text" name="nome_responsavel" id="nome_responsavel" value="{{ old('nome_responsavel', '') }}">
                @if($errors->has('nome_responsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_responsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.nome_responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profissao_do_responsavel">{{ trans('cruds.cadastro.fields.profissao_do_responsavel') }}</label>
                <input class="form-control {{ $errors->has('profissao_do_responsavel') ? 'is-invalid' : '' }}" type="text" name="profissao_do_responsavel" id="profissao_do_responsavel" value="{{ old('profissao_do_responsavel', '') }}">
                @if($errors->has('profissao_do_responsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissao_do_responsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.profissao_do_responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato_de_emergencia">{{ trans('cruds.cadastro.fields.contato_de_emergencia') }}</label>
                <input class="form-control {{ $errors->has('contato_de_emergencia') ? 'is-invalid' : '' }}" type="text" name="contato_de_emergencia" id="contato_de_emergencia" value="{{ old('contato_de_emergencia', '') }}">
                @if($errors->has('contato_de_emergencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato_de_emergencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.contato_de_emergencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nome_do_responsavel_2">{{ trans('cruds.cadastro.fields.nome_do_responsavel_2') }}</label>
                <input class="form-control {{ $errors->has('nome_do_responsavel_2') ? 'is-invalid' : '' }}" type="text" name="nome_do_responsavel_2" id="nome_do_responsavel_2" value="{{ old('nome_do_responsavel_2', '') }}">
                @if($errors->has('nome_do_responsavel_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_do_responsavel_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.nome_do_responsavel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profissao_do_responsavel_2">{{ trans('cruds.cadastro.fields.profissao_do_responsavel_2') }}</label>
                <input class="form-control {{ $errors->has('profissao_do_responsavel_2') ? 'is-invalid' : '' }}" type="text" name="profissao_do_responsavel_2" id="profissao_do_responsavel_2" value="{{ old('profissao_do_responsavel_2', '') }}">
                @if($errors->has('profissao_do_responsavel_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissao_do_responsavel_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.profissao_do_responsavel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato_de_emergencia_2">{{ trans('cruds.cadastro.fields.contato_de_emergencia_2') }}</label>
                <input class="form-control {{ $errors->has('contato_de_emergencia_2') ? 'is-invalid' : '' }}" type="text" name="contato_de_emergencia_2" id="contato_de_emergencia_2" value="{{ old('contato_de_emergencia_2', '') }}">
                @if($errors->has('contato_de_emergencia_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato_de_emergencia_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.contato_de_emergencia_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_do_responsavel_id">E-mail de usuário dos responsaveis</label>
                <select class="form-control select2" name="email_do_responsavel_id" id="email_do_responsavel_id">
                    @foreach($email_do_responsavel as $id => $entry)
                        <option value="{{ $id }}" {{ old('email_do_responsavel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.cor_raca') }}</label>
                <select class="form-control {{ $errors->has('cor_raca') ? 'is-invalid' : '' }}" name="cor_raca" id="cor_raca">
                    <option value disabled {{ old('cor_raca', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cadastro::COR_RACA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cor_raca', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cor_raca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cor_raca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.cor_raca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tipo_sanguineo">{{ trans('cruds.cadastro.fields.tipo_sanguineo') }}</label>
                <input class="form-control {{ $errors->has('tipo_sanguineo') ? 'is-invalid' : '' }}" type="text" name="tipo_sanguineo" id="tipo_sanguineo" value="{{ old('tipo_sanguineo', '') }}">
                @if($errors->has('tipo_sanguineo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_sanguineo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.tipo_sanguineo_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.problema_de_saude') }}</label>
                @foreach(App\Models\Cadastro::PROBLEMA_DE_SAUDE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('problema_de_saude') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="problema_de_saude_{{ $key }}" name="problema_de_saude" value="{{ $key }}" {{ old('problema_de_saude', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="problema_de_saude_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('problema_de_saude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('problema_de_saude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.problema_de_saude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sesim_qual">{{ trans('cruds.cadastro.fields.sesim_qual') }}</label>
                <input class="form-control {{ $errors->has('sesim_qual') ? 'is-invalid' : '' }}" type="text" name="sesim_qual" id="sesim_qual" value="{{ old('sesim_qual', '') }}">
                @if($errors->has('sesim_qual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sesim_qual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.sesim_qual_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.algum_medicamento') }}</label>
                @foreach(App\Models\Cadastro::ALGUM_MEDICAMENTO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('algum_medicamento') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="algum_medicamento_{{ $key }}" name="algum_medicamento" value="{{ $key }}" {{ old('algum_medicamento', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="algum_medicamento_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('algum_medicamento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('algum_medicamento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.algum_medicamento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sesim_qual_2">{{ trans('cruds.cadastro.fields.sesim_qual_2') }}</label>
                <input class="form-control {{ $errors->has('sesim_qual_2') ? 'is-invalid' : '' }}" type="text" name="sesim_qual_2" id="sesim_qual_2" value="{{ old('sesim_qual_2', '') }}">
                @if($errors->has('sesim_qual_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sesim_qual_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.sesim_qual_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.alguma_deficiencia') }}</label>
                @foreach(App\Models\Cadastro::ALGUMA_DEFICIENCIA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('alguma_deficiencia') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="alguma_deficiencia_{{ $key }}" name="alguma_deficiencia" value="{{ $key }}" {{ old('alguma_deficiencia', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="alguma_deficiencia_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('alguma_deficiencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alguma_deficiencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.alguma_deficiencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sesim_qual_3">{{ trans('cruds.cadastro.fields.sesim_qual_3') }}</label>
                <input class="form-control {{ $errors->has('sesim_qual_3') ? 'is-invalid' : '' }}" type="text" name="sesim_qual_3" id="sesim_qual_3" value="{{ old('sesim_qual_3', '') }}">
                @if($errors->has('sesim_qual_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sesim_qual_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.sesim_qual_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.alguma_alergia') }}</label>
                @foreach(App\Models\Cadastro::ALGUMA_ALERGIA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('alguma_alergia') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="alguma_alergia_{{ $key }}" name="alguma_alergia" value="{{ $key }}" {{ old('alguma_alergia', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="alguma_alergia_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('alguma_alergia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alguma_alergia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.alguma_alergia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sesim_qual_4">{{ trans('cruds.cadastro.fields.sesim_qual_4') }}</label>
                <input class="form-control {{ $errors->has('sesim_qual_4') ? 'is-invalid' : '' }}" type="text" name="sesim_qual_4" id="sesim_qual_4" value="{{ old('sesim_qual_4', '') }}">
                @if($errors->has('sesim_qual_4'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sesim_qual_4') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.sesim_qual_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.vai_a_escola') }}</label>
                <select class="form-control {{ $errors->has('vai_a_escola') ? 'is-invalid' : '' }}" name="vai_a_escola" id="vai_a_escola" onchange="showDiv('rota', this)">
                    <option value disabled {{ old('vai_a_escola', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cadastro::VAI_A_ESCOLA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('vai_a_escola', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('vai_a_escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vai_a_escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.vai_a_escola_helper') }}</span>
            </div>
            <div class="form-group" id="rota">
                <label for="rota_percorrida_id">{{ trans('cruds.cadastro.fields.rota_percorrida') }}</label>
                <select class="form-control select2 {{ $errors->has('rota_percorrida') ? 'is-invalid' : '' }}" name="rota_percorrida_id" id="rota_percorrida_id">
                  <option value=""> Selecione por favor </option>
                    @foreach($rota_percorridas as $rota_percorridas)
                        <option value="{{ $rota_percorridas->id }}" {{ old('rota_percorrida_id') == $rota_percorridas->id ? 'selected' : '' }}> Veiculo deixa {{ $rota_percorridas->origem }} as {{ $rota_percorridas->horario_de_saida }} e tem previsão de chegar a {{ $rota_percorridas->destino }} as {{ $rota_percorridas->horario_de_destino }} </option>
                    @endforeach
                </select>
                @if($errors->has('rota_percorrida'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rota_percorrida') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.rota_percorrida_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastro.fields.programa_maiseduca') }}</label>
                @foreach(App\Models\Cadastro::PROGRAMA_MAISEDUCA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('programa_maiseduca') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="programa_maiseduca_{{ $key }}" name="programa_maiseduca" value="{{ $key }}" {{ old('programa_maiseduca', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="programa_maiseduca_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('programa_maiseduca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('programa_maiseduca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.programa_maiseduca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arquivos_relacionados">{{ trans('cruds.cadastro.fields.arquivos_relacionados') }}</label>
                <div class="needsclick dropzone {{ $errors->has('arquivos_relacionados') ? 'is-invalid' : '' }}" id="arquivos_relacionados-dropzone">
                </div>
                @if($errors->has('arquivos_relacionados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arquivos_relacionados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastro.fields.arquivos_relacionados_helper') }}</span>
            </div>
            <input type="hidden" class="situacao" value="0" for="situacao" name="situacao">
            <input type="hidden" class="ano" value="{{ $ano }}" for="ano_id" name="ano_id">
            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
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

<style media="screen">

.group {
    display: flex;
}

.control {
    margin: 0px 10px 10px 10px;
    display: block;
    width: 60%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    background-clip: padding-box;
    border: 1px solid;
    color: #768192;
    background-color: #fff;
    border-color: #d8dbe0;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

#rota {
  display: none;
}

</style>

@endsection

@section('scripts')
<script type="text/javascript">

function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 'De Transporte Escolar' ? 'block' : 'none';
}

</script>
<script>
    Dropzone.options.fotoDoAlunoDropzone = {
    url: '{{ route('admin.cadastros.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 5000,
      height: 5000
    },
    success: function (file, response) {
      $('form').find('input[name="foto_do_aluno"]').remove()
      $('form').append('<input type="hidden" name="foto_do_aluno" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="foto_do_aluno"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($cadastro) && $cadastro->foto_do_aluno)
      var file = {!! json_encode($cadastro->foto_do_aluno) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="foto_do_aluno" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    var uploadedArquivosRelacionadosMap = {}
Dropzone.options.arquivosRelacionadosDropzone = {
    url: '{{ route('admin.cadastros.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="arquivos_relacionados[]" value="' + response.name + '">')
      uploadedArquivosRelacionadosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedArquivosRelacionadosMap[file.name]
      }
      $('form').find('input[name="arquivos_relacionados[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($cadastro) && $cadastro->arquivos_relacionados)
          var files =
            {!! json_encode($cadastro->arquivos_relacionados) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="arquivos_relacionados[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
