@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Rota
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rota.update", [$rotum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ano">{{ trans('cruds.rotum.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $rotum->ano) }}" step="1">
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.rotum.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao', $rotum->descricao) !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block"> caso necessário, adicione uma descrição sobre a rota em questão. </span>
            </div>
            <div class="form-group">
                <label for="horario_de_saida">{{ trans('cruds.rotum.fields.horario_de_saida') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_de_saida') ? 'is-invalid' : '' }}" type="text" name="horario_de_saida" id="horario_de_saida" value="{{ old('horario_de_saida', $rotum->horario_de_saida) }}">
                @if($errors->has('horario_de_saida'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_de_saida') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.horario_de_saida_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="origem">{{ trans('cruds.rotum.fields.origem') }}</label>
                <input class="form-control {{ $errors->has('origem') ? 'is-invalid' : '' }}" type="text" name="origem" id="origem" value="{{ old('origem', $rotum->origem) }}">
                @if($errors->has('origem'))
                    <div class="invalid-feedback">
                        {{ $errors->first('origem') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.origem_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_de_destino">{{ trans('cruds.rotum.fields.horario_de_destino') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_de_destino') ? 'is-invalid' : '' }}" type="text" name="horario_de_destino" id="horario_de_destino" value="{{ old('horario_de_destino', $rotum->horario_de_destino) }}">
                @if($errors->has('horario_de_destino'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_de_destino') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.horario_de_destino_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="destino">{{ trans('cruds.rotum.fields.destino') }}</label>
                <input class="form-control {{ $errors->has('destino') ? 'is-invalid' : '' }}" type="text" name="destino" id="destino" value="{{ old('destino', $rotum->destino) }}">
                @if($errors->has('destino'))
                    <div class="invalid-feedback">
                        {{ $errors->first('destino') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.destino_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quilometros_percorridos">{{ trans('cruds.rotum.fields.quilometros_percorridos') }}</label>
                <input class="form-control {{ $errors->has('quilometros_percorridos') ? 'is-invalid' : '' }}" type="text" name="quilometros_percorridos" id="quilometros_percorridos" value="{{ old('quilometros_percorridos', $rotum->quilometros_percorridos) }}">
                @if($errors->has('quilometros_percorridos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quilometros_percorridos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.quilometros_percorridos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="veiculo_responsavel_id">{{ trans('cruds.rotum.fields.veiculo_responsavel') }}</label>
                <select class="form-control select2 {{ $errors->has('veiculo_responsavel') ? 'is-invalid' : '' }}" name="veiculo_responsavel_id" id="veiculo_responsavel_id">
                  <option value=""> Selecione por favor </option>
                    @foreach($veiculo as $veiculo)
                        <option value="{{ $veiculo->id }}" {{ (old('veiculo_responsavel_id') ? old('veiculo_responsavel_id') : $rotum->veiculo_responsavel->id ?? '') == $veiculo->id ? 'selected' : '' }}> Marca: {{ $veiculo->marca }}, Placa: {{ $veiculo->placa ?? '' }}, {{ $veiculo->descricao ?? '' }} </option>
                    @endforeach
                </select>
                @if($errors->has('veiculo_responsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('veiculo_responsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.veiculo_responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="motorista_responsavel_id">{{ trans('cruds.rotum.fields.motorista_responsavel') }}</label>
                <select class="form-control select2 {{ $errors->has('motorista_responsavel') ? 'is-invalid' : '' }}" name="motorista_responsavel_id" id="motorista_responsavel_id">
                    @foreach($motorista_responsavels as $id => $entry)
                        <option value="{{ $id }}" {{ (old('motorista_responsavel_id') ? old('motorista_responsavel_id') : $rotum->motorista_responsavel->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('motorista_responsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motorista_responsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rotum.fields.motorista_responsavel_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.rota.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $rotum->id ?? 0 }}');
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
