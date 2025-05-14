@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.propostasDeAula.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.propostas-de-aulas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="titulo">{{ trans('cruds.propostasDeAula.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resumo">{{ trans('cruds.propostasDeAula.fields.resumo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('resumo') ? 'is-invalid' : '' }}" name="resumo" id="resumo">{!! old('resumo') !!}</textarea>
                @if($errors->has('resumo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resumo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.resumo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="autor">{{ trans('cruds.propostasDeAula.fields.autor') }}</label>
                <input class="form-control {{ $errors->has('autor') ? 'is-invalid' : '' }}" type="text" name="autor" id="autor" value="{{ old('autor', '') }}">
                @if($errors->has('autor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('autor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.autor_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.propostasDeAula.fields.publico_alvo') }}</label>
                <select class="form-control {{ $errors->has('publico_alvo') ? 'is-invalid' : '' }}" name="publico_alvo" id="publico_alvo">
                    <option value disabled {{ old('publico_alvo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PropostasDeAula::PUBLICO_ALVO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('publico_alvo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('publico_alvo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publico_alvo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.publico_alvo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area_de_conhecimento">{{ trans('cruds.propostasDeAula.fields.area_de_conhecimento') }}</label>
                <input class="form-control {{ $errors->has('area_de_conhecimento') ? 'is-invalid' : '' }}" type="text" name="area_de_conhecimento" id="area_de_conhecimento" value="{{ old('area_de_conhecimento', '') }}">
                @if($errors->has('area_de_conhecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_de_conhecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.area_de_conhecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objetivo">{{ trans('cruds.propostasDeAula.fields.objetivo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo" id="objetivo">{!! old('objetivo') !!}</textarea>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.objetivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="metodologia">{{ trans('cruds.propostasDeAula.fields.metodologia') }}</label>
                <input class="form-control {{ $errors->has('metodologia') ? 'is-invalid' : '' }}" type="text" name="metodologia" id="metodologia" value="{{ old('metodologia', '') }}">
                @if($errors->has('metodologia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('metodologia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.metodologia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="finalidade">{{ trans('cruds.propostasDeAula.fields.finalidade') }}</label>
                <input class="form-control {{ $errors->has('finalidade') ? 'is-invalid' : '' }}" type="text" name="finalidade" id="finalidade" value="{{ old('finalidade', '') }}">
                @if($errors->has('finalidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finalidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.finalidade_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('aceito') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="aceito" id="aceito" value="1" required {{ old('aceito', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="aceito">{{ trans('cruds.propostasDeAula.fields.aceito') }}</label>
                </div>
                @if($errors->has('aceito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aceito') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.propostasDeAula.fields.aceito_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.propostas-de-aulas.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $propostasDeAula->id ?? 0 }}');
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
