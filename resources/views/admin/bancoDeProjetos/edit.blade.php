@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Projeto
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.banco-de-projetos.update", [$bancoDeProjeto->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="titulo">{{ trans('cruds.bancoDeProjeto.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $bancoDeProjeto->titulo) }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resumo">{{ trans('cruds.bancoDeProjeto.fields.resumo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('resumo') ? 'is-invalid' : '' }}" name="resumo" id="resumo">{!! old('resumo', $bancoDeProjeto->resumo) !!}</textarea>
                @if($errors->has('resumo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resumo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.resumo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="autor">{{ trans('cruds.bancoDeProjeto.fields.autor') }}</label>
                <input class="form-control {{ $errors->has('autor') ? 'is-invalid' : '' }}" type="text" name="autor" id="autor" value="{{ old('autor', $bancoDeProjeto->autor) }}">
                @if($errors->has('autor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('autor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.autor_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bancoDeProjeto.fields.publico_alvo') }}</label>
                <select class="form-control {{ $errors->has('publico_alvo') ? 'is-invalid' : '' }}" name="publico_alvo" id="publico_alvo">
                    <option value disabled {{ old('publico_alvo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\BancoDeProjeto::PUBLICO_ALVO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('publico_alvo', $bancoDeProjeto->publico_alvo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('publico_alvo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publico_alvo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.publico_alvo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area_de_conhecimento">{{ trans('cruds.bancoDeProjeto.fields.area_de_conhecimento') }}</label>
                <input class="form-control {{ $errors->has('area_de_conhecimento') ? 'is-invalid' : '' }}" type="text" name="area_de_conhecimento" id="area_de_conhecimento" value="{{ old('area_de_conhecimento', $bancoDeProjeto->area_de_conhecimento) }}">
                @if($errors->has('area_de_conhecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_de_conhecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.area_de_conhecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objetivo">{{ trans('cruds.bancoDeProjeto.fields.objetivo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo" id="objetivo">{!! old('objetivo', $bancoDeProjeto->objetivo) !!}</textarea>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.objetivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="metodologia">{{ trans('cruds.bancoDeProjeto.fields.metodologia') }}</label>
                <input class="form-control {{ $errors->has('metodologia') ? 'is-invalid' : '' }}" type="text" name="metodologia" id="metodologia" value="{{ old('metodologia', $bancoDeProjeto->metodologia) }}">
                @if($errors->has('metodologia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('metodologia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.metodologia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="finalidade">{{ trans('cruds.bancoDeProjeto.fields.finalidade') }}</label>
                <input class="form-control {{ $errors->has('finalidade') ? 'is-invalid' : '' }}" type="text" name="finalidade" id="finalidade" value="{{ old('finalidade', $bancoDeProjeto->finalidade) }}">
                @if($errors->has('finalidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finalidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.finalidade_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('aceito') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="aceito" id="aceito" value="1" {{ $bancoDeProjeto->aceito || old('aceito', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="aceito">{{ trans('cruds.bancoDeProjeto.fields.aceito') }}</label>
                </div>
                @if($errors->has('aceito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aceito') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bancoDeProjeto.fields.aceito_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.banco-de-projetos.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $bancoDeProjeto->id ?? 0 }}');
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
