@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Comunicado
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-alerts.update", [$userAlert->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="alert_text">{{ trans('cruds.userAlert.fields.alert_text') }}</label>
                <input class="form-control {{ $errors->has('alert_text') ? 'is-invalid' : '' }}" type="text" name="alert_text" id="alert_text" value="{{ old('alert_text', $userAlert->alert_text) }}" required>
                @if($errors->has('alert_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alert_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="texto">{{ trans('cruds.userAlert.fields.texto') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('texto') ? 'is-invalid' : '' }}" name="texto" id="texto">{!! old('texto', $userAlert->texto) !!}</textarea>
                @if($errors->has('texto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('texto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.texto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anexos">{{ trans('cruds.userAlert.fields.anexos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('anexos') ? 'is-invalid' : '' }}" id="anexos-dropzone">
                </div>
                @if($errors->has('anexos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anexos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.anexos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instituicoes_id">{{ trans('cruds.userAlert.fields.instituicoes') }}</label>
                <select class="form-control select2 {{ $errors->has('instituicoes') ? 'is-invalid' : '' }}" name="instituicoes_id" id="instituicoes_id" required>
                    @foreach($instituicoes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('instituicoes_id') ? old('instituicoes_id') : $userAlert->instituicoes->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('instituicoes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instituicoes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.instituicoes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hierarquias_id">{{ trans('cruds.userAlert.fields.hierarquias') }}</label>
                <select class="form-control select2 {{ $errors->has('hierarquias') ? 'is-invalid' : '' }}" name="hierarquias_id" id="hierarquias_id" required>
                    @foreach($hierarquias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('hierarquias_id') ? old('hierarquias_id') : $userAlert->hierarquias->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hierarquias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hierarquias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.hierarquias_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="users">{{ trans('cruds.userAlert.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $userAlert->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.user_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.user-alerts.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $userAlert->id ?? 0 }}');
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
    Dropzone.options.anexosDropzone = {
    url: '{{ route('admin.user-alerts.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="anexos"]').remove()
      $('form').append('<input type="hidden" name="anexos" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="anexos"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($userAlert) && $userAlert->anexos)
      var file = {!! json_encode($userAlert->anexos) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="anexos" value="' + file.file_name + '">')
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
@endsection
