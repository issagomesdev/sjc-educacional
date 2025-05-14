@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Profissional
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.profissionais.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nome_completo">Nome Completo</label>
                <input class="form-control {{ $errors->has('nome_completo') ? 'is-invalid' : '' }}" type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo') }}" required>
                @if($errors->has('nome_completo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_completo') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="data_de_nascimento">Data de nascimento</label>
                <input class="form-control date {{ $errors->has('data_de_nascimento') ? 'is-invalid' : '' }}" type="text" name="data_de_nascimento" id="data_de_nascimento" value="{{ old('data_de_nascimento') }}">
                @if($errors->has('data_de_nascimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_de_nascimento') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Genero </label>
                @foreach(App\Models\Profissionai::GENERO_RADIO as $key => $label)
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
                <span class="help-block">  </span>
            </div>
            <div class="form-group">
                <label for="nome_do_pai">Nome do pai</label>
                <input class="form-control" type="text" name="nome_do_pai" id="nome_do_pai" value="{{ old('nome_do_pai', '') }}">
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="numero_de_contato">Nome da mãe</label>
                <input class="form-control {{ $errors->has('nome_da_mae') ? 'is-invalid' : '' }}" type="text" name="nome_da_mae" id="nome_da_mae" value="{{ old('nome_da_mae', '') }}">
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label>{{ trans('Estado Civil') }}</label>
                <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" name="estado_civil" id="estado_civil">
                    <option value disabled {{ old('estado_civil', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::ESTADO_CIVIL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado_civil', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado_civil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado_civil') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="numero_de_contato"> Cadastro de Pessoa Física (CPF) </label>
                <input class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text" name="cpf" id="cpf" value="{{ old('cpf', '') }}">
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="numero_de_contato">Registro Geral (RG)</label>
                <input class="form-control {{ $errors->has('rg') ? 'is-invalid' : '' }}" type="text" name="rg" id="rg" value="{{ old('rg', '') }}">
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Localização </label>
                @foreach(App\Models\Profissionai::LOCALIZACAO_RADIO as $key => $label)
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
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Estado </label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="bairro"> Bairro </label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="ano_de_contratacao">Ano de Contratação</label>
                <input class="form-control {{ $errors->has('ano_de_contratacao') ? 'is-invalid' : '' }}" type="number" name="ano_de_contratacao" id="ano_de_contratacao" value="{{ old('ano_de_contratacao', '') }}" step="1">
                @if($errors->has('ano_de_contratacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano_de_contratacao') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Situação de Contratação </label>
                <select class="form-control {{ $errors->has('situacao_de_contratacao') ? 'is-invalid' : '' }}" name="situacao_de_contratacao" id="situacao_de_contratacao">
                    <option value disabled {{ old('situacao_de_contratacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao_de_contratacao', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao_de_contratacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao_de_contratacao') }}
                    </div>
                @endif
                <span class="help-block">  </span>
            </div>
            <div class="form-group">
                <label> Escolaridade </label>
                <select class="form-control {{ $errors->has('escolaridade') ? 'is-invalid' : '' }}" name="escolaridade" id="escolaridade">
                    <option value disabled {{ old('escolaridade', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::ESCOLARIDADE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('escolaridade', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('escolaridade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escolaridade') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label>Tipo de tipo ensino médio cursado</label>
                <select class="form-control {{ $errors->has('ensino_medio_cursado') ? 'is-invalid' : '' }}" name="ensino_medio_cursado" id="ensino_medio_cursado">
                    <option value disabled {{ old('ensino_medio_cursado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::ENSINO_MEDIO_CURSADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('ensino_medio_cursado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('ensino_medio_cursado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ensino_medio_cursado') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label>Pós-Graduações concluídas</label>
                <select class="form-control {{ $errors->has('pos_concluidas') ? 'is-invalid' : '' }}" name="pos_concluidas" id="pos_concluidas">
                    <option value disabled {{ old('pos_concluidas', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Profissionai::POS_CONCLUIDAS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('pos_concluidas', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('pos_concluidas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pos_concluidas') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="numero_de_contato">Numero De Contato</label>
                <input class="form-control {{ $errors->has('numero_de_contato') ? 'is-invalid' : '' }}" type="text" name="numero_de_contato" id="numero_de_contato" value="{{ old('numero_de_contato', '') }}">
                @if($errors->has('numero_de_contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_de_contato') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="e_mail_de_usuario_id">E-mail de Usuário</label>
                <select class="form-control select2 {{ $errors->has('e_mail_de_usuario') ? 'is-invalid' : '' }}" name="e_mail_de_usuario_id" id="e_mail_de_usuario_id">
                    @foreach($e_mail_de_usuarios as $id => $entry)
                        <option value="{{ $id }}" {{ old('e_mail_de_usuario_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('e_mail_de_usuario'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_mail_de_usuario') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="e_mail_de_contato">E-Mail De Contato</label>
                <input class="form-control {{ $errors->has('e_mail_de_contato') ? 'is-invalid' : '' }}" type="text" name="e_mail_de_contato" id="e_mail_de_contato" value="{{ old('e_mail_de_contato', '') }}">
                @if($errors->has('e_mail_de_contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_mail_de_contato') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="arquivos_relacionados"> Arquivos Relacionados </label>
                <div class="needsclick dropzone {{ $errors->has('arquivos_relacionados') ? 'is-invalid' : '' }}" id="arquivos_relacionados-dropzone">
                </div>
                @if($errors->has('arquivos_relacionados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arquivos_relacionados') }}
                    </div>
                @endif
                <span class="help-block">  </span>
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

@section('scripts')
<script>
    var uploadedArquivosRelacionadosMap = {}
Dropzone.options.arquivosRelacionadosDropzone = {
    url: '{{ route('admin.profissionais.storeMedia') }}',
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1
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
@if(isset($profissionai) && $profissionai->arquivos_relacionados)
          var files =
            {!! json_encode($profissionai->arquivos_relacionados) !!}
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
