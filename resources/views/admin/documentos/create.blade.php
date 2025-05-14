@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Registrar Documento
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.documentos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome">{{ trans('cruds.documento.fields.nome') }}</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome" id="nome" value="{{ old('nome', '') }}">
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.nome_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.documento.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao') !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anexos">{{ trans('cruds.documento.fields.anexos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('anexos') ? 'is-invalid' : '' }}" id="anexos-dropzone">
                </div>
                @if($errors->has('anexos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anexos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.anexos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instituicao_id"> Instituição destinada ao documento </label>
                <select class="form-control select2 {{ $errors->has('instituicao') ? 'is-invalid' : '' }}" name="instituicao_id" id="instituicao_id">
                    @foreach($instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ old('instituicao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicao') }}
                    </div>
                @endif
                <span class="help-block"> </span>
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
                xhr.open('POST', '{{ route('admin.documentos.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $documento->id ?? 0 }}');
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

<script>
    var uploadedAnexosMap = {}
Dropzone.options.anexosDropzone = {
    url: '{{ route('admin.documentos.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="anexos[]" value="' + response.name + '">')
      uploadedAnexosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAnexosMap[file.name]
      }
      $('form').find('input[name="anexos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($documento) && $documento->anexos)
          var files =
            {!! json_encode($documento->anexos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="anexos[]" value="' + file.file_name + '">')
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
