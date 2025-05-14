@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Suspensão de Aulas
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.semaulas.update", [$semaula->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.semaula.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $semaula->titulo) }}">
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.semaula.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="de">{{ trans('cruds.semaula.fields.de') }}</label>
                <input class="form-control datetime {{ $errors->has('de') ? 'is-invalid' : '' }}" type="text" name="de" id="de" value="{{ old('de', $semaula->de) }}">
                @if($errors->has('de'))
                    <div class="invalid-feedback">
                        {{ $errors->first('de') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.semaula.fields.de_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ate">{{ trans('cruds.semaula.fields.ate') }}</label>
                <input class="form-control datetime {{ $errors->has('ate') ? 'is-invalid' : '' }}" type="text" name="ate" id="ate" value="{{ old('ate', $semaula->ate) }}" required>
                @if($errors->has('ate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.semaula.fields.ate_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.semaula.fields.motivo') }}</label>
                <select class="form-control {{ $errors->has('motivo') ? 'is-invalid' : '' }}" name="motivo" id="motivo">
                    <option value disabled {{ old('motivo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Semaula::MOTIVO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('motivo', $semaula->motivo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('motivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.semaula.fields.motivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.semaula.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao', $semaula->descricao) !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.semaula.fields.descricao_helper') }}</span>
            </div>
            @if($auth[0] == 2)
            <div class="form-group">
                <label for="instituicao_id">Instituição</label>
                <select class="form-control select2" name="instituicao_id" id="instituicao_id" required>
                    @foreach($instituicao as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicao_id') ? old('instituicao_id') : $semaula->instituicao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            @endif
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
                xhr.open('POST', '{{ route('admin.semaulas.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $semaula->id ?? 0 }}');
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
