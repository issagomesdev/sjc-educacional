@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.planejamentoBimestral.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.planejamento-bimestrals.update", [$planejamentoBimestral->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="aula_n">Aulas N</label>
                <input class="form-control {{ $errors->has('aula_n') ? 'is-invalid' : '' }}" type="number" name="aula_n" id="aula_n" value="{{ old('aula_n', $planejamentoBimestral->aula_n) }}" step="1">
                @if($errors->has('aula_n'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aula_n') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="disciplina_id">{{ trans('cruds.planejamentoBimestral.fields.disciplina') }}</label>
                <select class="form-control select2 {{ $errors->has('disciplina') ? 'is-invalid' : '' }}" name="disciplina_id" id="disciplina_id">
                    @foreach($disciplinas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('disciplina_id') ? old('disciplina_id') : $planejamentoBimestral->disciplina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplina'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disciplina') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.disciplina_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="escola_id">{{ trans('cruds.planejamentoBimestral.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id">
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('escola_id') ? old('escola_id') : $planejamentoBimestral->escola->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.escola_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="turma_id">{{ trans('cruds.planejamentoBimestral.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id">
                    @foreach($turmas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('turma_id') ? old('turma_id') : $planejamentoBimestral->turma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="justificativa">{{ trans('cruds.planejamentoBimestral.fields.justificativa') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('justificativa') ? 'is-invalid' : '' }}" name="justificativa" id="justificativa">{!! old('justificativa', $planejamentoBimestral->justificativa) !!}</textarea>
                @if($errors->has('justificativa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('justificativa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.justificativa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objetivos">{{ trans('cruds.planejamentoBimestral.fields.objetivos') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('objetivos') ? 'is-invalid' : '' }}" name="objetivos" id="objetivos">{!! old('objetivos', $planejamentoBimestral->objetivos) !!}</textarea>
                @if($errors->has('objetivos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.objetivos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conteudos">{{ trans('cruds.planejamentoBimestral.fields.conteudos') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('conteudos') ? 'is-invalid' : '' }}" name="conteudos" id="conteudos">{!! old('conteudos', $planejamentoBimestral->conteudos) !!}</textarea>
                @if($errors->has('conteudos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conteudos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.conteudos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="procedimentos_metodologicos">{{ trans('cruds.planejamentoBimestral.fields.procedimentos_metodologicos') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('procedimentos_metodologicos') ? 'is-invalid' : '' }}" name="procedimentos_metodologicos" id="procedimentos_metodologicos">{!! old('procedimentos_metodologicos', $planejamentoBimestral->procedimentos_metodologicos) !!}</textarea>
                @if($errors->has('procedimentos_metodologicos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('procedimentos_metodologicos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.procedimentos_metodologicos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="procedimentos_avaliativos">{{ trans('cruds.planejamentoBimestral.fields.procedimentos_avaliativos') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('procedimentos_avaliativos') ? 'is-invalid' : '' }}" name="procedimentos_avaliativos" id="procedimentos_avaliativos">{!! old('procedimentos_avaliativos', $planejamentoBimestral->procedimentos_avaliativos) !!}</textarea>
                @if($errors->has('procedimentos_avaliativos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('procedimentos_avaliativos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planejamentoBimestral.fields.procedimentos_avaliativos_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.planejamento-bimestrals.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $planejamentoBimestral->id ?? 0 }}');
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
