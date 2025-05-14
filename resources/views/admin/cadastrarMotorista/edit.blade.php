@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Motorista
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cadastrar-motorista.update", [$cadastrarMotoristum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nome_completo">{{ trans('cruds.cadastrarMotoristum.fields.nome_completo') }}</label>
                <input class="form-control {{ $errors->has('nome_completo') ? 'is-invalid' : '' }}" type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo', $cadastrarMotoristum->nome_completo) }}">
                @if($errors->has('nome_completo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_completo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.nome_completo_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarMotoristum.fields.genero') }}</label>
                @foreach(App\Models\CadastrarMotoristum::GENERO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('genero') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="genero_{{ $key }}" name="genero" value="{{ $key }}" {{ old('genero', $cadastrarMotoristum->genero) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="genero_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.genero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_de_nascimento">{{ trans('cruds.cadastrarMotoristum.fields.data_de_nascimento') }}</label>
                <input class="form-control date {{ $errors->has('data_de_nascimento') ? 'is-invalid' : '' }}" type="text" name="data_de_nascimento" id="data_de_nascimento" value="{{ old('data_de_nascimento', $cadastrarMotoristum->data_de_nascimento) }}">
                @if($errors->has('data_de_nascimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_de_nascimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.data_de_nascimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_da_habilitacao">{{ trans('cruds.cadastrarMotoristum.fields.data_da_habilitacao') }}</label>
                <input class="form-control date {{ $errors->has('data_da_habilitacao') ? 'is-invalid' : '' }}" type="text" name="data_da_habilitacao" id="data_da_habilitacao" value="{{ old('data_da_habilitacao', $cadastrarMotoristum->data_da_habilitacao) }}">
                @if($errors->has('data_da_habilitacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_da_habilitacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.data_da_habilitacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vencimento_da_habilitacao">{{ trans('cruds.cadastrarMotoristum.fields.vencimento_da_habilitacao') }}</label>
                <input class="form-control date {{ $errors->has('vencimento_da_habilitacao') ? 'is-invalid' : '' }}" type="text" name="vencimento_da_habilitacao" id="vencimento_da_habilitacao" value="{{ old('vencimento_da_habilitacao', $cadastrarMotoristum->vencimento_da_habilitacao) }}">
                @if($errors->has('vencimento_da_habilitacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vencimento_da_habilitacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.vencimento_da_habilitacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="codigo_do_motorista">{{ trans('cruds.cadastrarMotoristum.fields.codigo_do_motorista') }}</label>
                <input class="form-control {{ $errors->has('codigo_do_motorista') ? 'is-invalid' : '' }}" type="text" name="codigo_do_motorista" id="codigo_do_motorista" value="{{ old('codigo_do_motorista', $cadastrarMotoristum->codigo_do_motorista) }}">
                @if($errors->has('codigo_do_motorista'))
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo_do_motorista') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.codigo_do_motorista_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cnh">{{ trans('cruds.cadastrarMotoristum.fields.cnh') }}</label>
                <input class="form-control {{ $errors->has('cnh') ? 'is-invalid' : '' }}" type="text" name="cnh" id="cnh" value="{{ old('cnh', $cadastrarMotoristum->cnh) }}">
                @if($errors->has('cnh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cnh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.cnh_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cpf">{{ trans('cruds.cadastrarMotoristum.fields.cpf') }}</label>
                <input class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text" name="cpf" id="cpf" value="{{ old('cpf', $cadastrarMotoristum->cpf) }}">
                @if($errors->has('cpf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cpf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rg">{{ trans('cruds.cadastrarMotoristum.fields.rg') }}</label>
                <input class="form-control {{ $errors->has('rg') ? 'is-invalid' : '' }}" type="text" name="rg" id="rg" value="{{ old('rg', $cadastrarMotoristum->rg) }}">
                @if($errors->has('rg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.rg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observacoes">{{ trans('cruds.cadastrarMotoristum.fields.observacoes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('observacoes') ? 'is-invalid' : '' }}" name="observacoes" id="observacoes">{!! old('observacoes', $cadastrarMotoristum->observacoes) !!}</textarea>
                @if($errors->has('observacoes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observacoes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.observacoes_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarMotoristum.fields.localizacao') }}</label>
                @foreach(App\Models\CadastrarMotoristum::LOCALIZACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('localizacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="localizacao_{{ $key }}" name="localizacao" value="{{ $key }}" {{ old('localizacao', $cadastrarMotoristum->localizacao) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="localizacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarMotoristum.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CadastrarMotoristum::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', $cadastrarMotoristum->estado) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.cadastrarMotoristum.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', $cadastrarMotoristum->cidade) }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.cadastrarMotoristum.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', $cadastrarMotoristum->bairro) }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.cadastrarMotoristum.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', $cadastrarMotoristum->endereco) }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ano_de_contratacao">{{ trans('cruds.cadastrarMotoristum.fields.ano_de_contratacao') }}</label>
                <input class="form-control {{ $errors->has('ano_de_contratacao') ? 'is-invalid' : '' }}" type="number" name="ano_de_contratacao" id="ano_de_contratacao" value="{{ old('ano_de_contratacao', $cadastrarMotoristum->ano_de_contratacao) }}" step="1">
                @if($errors->has('ano_de_contratacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano_de_contratacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.ano_de_contratacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarMotoristum.fields.situacao_de_contratacao') }}</label>
                <select class="form-control {{ $errors->has('situacao_de_contratacao') ? 'is-invalid' : '' }}" name="situacao_de_contratacao" id="situacao_de_contratacao">
                    <option value disabled {{ old('situacao_de_contratacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CadastrarMotoristum::SITUACAO_DE_CONTRATACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao_de_contratacao', $cadastrarMotoristum->situacao_de_contratacao) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao_de_contratacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao_de_contratacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.situacao_de_contratacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero_de_telefone">{{ trans('cruds.cadastrarMotoristum.fields.numero_de_telefone') }}</label>
                <input class="form-control {{ $errors->has('numero_de_telefone') ? 'is-invalid' : '' }}" type="text" name="numero_de_telefone" id="numero_de_telefone" value="{{ old('numero_de_telefone', $cadastrarMotoristum->numero_de_telefone) }}">
                @if($errors->has('numero_de_telefone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_de_telefone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.numero_de_telefone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instituicao_id">{{ trans('cruds.cadastrarMotoristum.fields.instituicao') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id">
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicao_id') ? old('instituicao_id') : $cadastrarMotoristum->instituicao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarMotoristum.fields.instituicao_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.cadastrar-motorista.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $cadastrarMotoristum->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection
