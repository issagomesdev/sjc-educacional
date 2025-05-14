@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Conteudo Curricular
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.conteudos-curriculares.update", [$conteudosCurriculare->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label> Base Curricular </label>
                <select class="form-control" name="bncc_x_cdp" id="bncc_x_cdp" onchange="showDiv1(this)" required>
                    <option value=""> Selecione por favor </option>
                    <option value="BNCC" {{ old('bncc_x_cdp', $conteudosCurriculare->bncc_x_cdp) === (string) "BNCC" ? 'selected' : '' }}> BNCC </option>
                    <option value="CDP" {{ old('bncc_x_cdp', $conteudosCurriculare->bncc_x_cdp) === (string) "CDP" ? 'selected' : '' }}> Currículo de Pernambuco </option>
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group" id="bncc" style="display:none;">
                <label for="bncc_id"> BNCC </label>
                <select class="form-control select2" name="bncc_id" id="bncc_id">
                  <option value="">Selecione por favor</option>
                    @foreach($bnccs as $bncc)
                        <option value="{{ $bncc->id }}" {{ (old('bncc_id') ? old('bncc_id') : $conteudosCurriculare->bncc->id ?? '') == $bncc->id ? 'selected' : '' }}> {{ $bncc->codigo }} • {{$bncc->nivel_de_ensino}} • {{ $bncc->disciplina->nome_da_materia ?? '' }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group" id="cdp" style="display:none;">
                <label for="cdp_id"> Currículo de Pernambuco </label>
                <select class="form-control select2" name="cdp_id" id="cdp_id">
                  <option value="">Selecione por favor</option>
                    @foreach($cdps as $cdp)
                        <option value="{{ $cdp->id }}" {{ (old('cdp_id') ? old('cdp_id') : $conteudosCurriculare->cdp->id ?? '') == $cdp->id ? 'selected' : '' }}>{{ $cdp->codigo }} • {{$cdp->nivel_de_ensino}} • {{ $cdp->disciplina->nome_da_materia ?? '' }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Nivel de Ensino </label>
                <select class="form-control" name="nivel_de_ensino" id="nivel_de_ensino" onchange="showDiv2(this)" required>
                    <option value=""> Selecione por favor </option>
                    <option value="Ensino Infantil" {{ old('nivel_de_ensino', $conteudosCurriculare->nivel_de_ensino) === (string) "Ensino Infantil" ? 'selected' : '' }}> Ensino Infantil </option>
                    <option value="Ensino Fundamental 1" {{ old('nivel_de_ensino', $conteudosCurriculare->nivel_de_ensino) === (string) "Ensino Fundamental 1" ? 'selected' : '' }}> Ensino Fundamental 1 </option>
                    <option value="Ensino Fundamental 2" {{ old('nivel_de_ensino', $conteudosCurriculare->nivel_de_ensino) === (string) "Ensino Fundamental 2" ? 'selected' : '' }}> Ensino Fundamental 2 </option>
                    <option value="EJA" {{ old('nivel_de_ensino', $conteudosCurriculare->nivel_de_ensino) === (string) "EJA" ? 'selected' : '' }}> EJA </option>
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group" id="disciplina" style="display:none;">
                <label class="required" for="disciplina_id">{{ trans('cruds.conteudosCurriculare.fields.disciplina') }}</label>
                <select class="form-control select2 {{ $errors->has('disciplina') ? 'is-invalid' : '' }}" name="disciplina_id" id="disciplina_id">
                    @foreach($disciplinas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('disciplina_id') ? old('disciplina_id') : $conteudosCurriculare->disciplina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplina'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disciplina') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.disciplina_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.conteudosCurriculare.fields.bimestres') }}</label>
                <select class="form-control {{ $errors->has('bimestres') ? 'is-invalid' : '' }}" name="bimestres" id="bimestres" required>
                    <option value disabled {{ old('bimestres', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ConteudosCurriculare::BIMESTRES_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('bimestres', $conteudosCurriculare->bimestres) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('bimestres'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bimestres') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.bimestres_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="turmas"> Series </label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2" name="serie[]" id="serie" multiple>
                    <option value="Creche I" {{ in_array("Creche I", $series) ? 'selected' : '' }} > Creche - 0 a 1 ano e 6 meses </option>
                    <option value="Creche II" {{ in_array("Creche II", $series) ? 'selected' : '' }}> Creche - 1 ano e 7 meses a 3 anos e 11 meses </option>
                    <option value="Pré-escolar" {{ in_array("Pré-escolar", $series) ? 'selected' : '' }}> Pré-escolar - 4 a 5 anos </option>
                    <option value="1º ano" {{ in_array("1º ano", $series) ? 'selected' : '' }}> 1º ano - Fundamental I </option>
                    <option value="2º ano" {{ in_array("2º ano", $series) ? 'selected' : '' }}> 2º ano - Fundamental I </option>
                    <option value="3º ano" {{ in_array("3º ano", $series) ? 'selected' : '' }}> 3º ano - Fundamental I </option>
                    <option value="4º ano" {{ in_array("4º ano", $series)  ? 'selected' : '' }}> 4º ano - Fundamental I </option>
                    <option value="5º ano" {{ in_array("5º ano", $series)  ? 'selected' : '' }}> 5º ano - Fundamental I </option>
                    <option value="6º ano" {{ in_array("6º ano", $series)  ? 'selected' : '' }}> 6º ano - Fundamental II </option>
                    <option value="7º ano" {{ in_array("7º ano", $series)  ? 'selected' : '' }}> 7º ano - Fundamental II </option>
                    <option value="8º ano" {{ in_array("8º ano", $series)  ? 'selected' : '' }}> 8º ano - Fundamental II </option>
                    <option value="9º ano" {{ in_array("9º ano", $series) ? 'selected' : '' }}> 9º ano - Fundamental II </option>
                    <option value="1º ano(EJA)" {{ in_array("1º ano(EJA)", $series) ? 'selected' : '' }}> 1º ano - EJA </option>
                    <option value="2º ano(EJA)" {{ in_array("2º ano(EJA)", $series) ? 'selected' : '' }}> 2º ano - EJA </option>
                    <option value="3º ano(EJA)" {{ in_array("3º ano(EJA)", $series) ? 'selected' : '' }}> 3º ano - EJA </option>
                </select>

                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label>{{ trans('cruds.conteudosCurriculare.fields.campo_eixo') }}</label>
                <select class="form-control {{ $errors->has('campo_eixo') ? 'is-invalid' : '' }}" name="campo_eixo" id="campo_eixo">
                    <option value disabled {{ old('campo_eixo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ConteudosCurriculare::CAMPO_EIXO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('campo_eixo', $conteudosCurriculare->campo_eixo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('campo_eixo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('campo_eixo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.campo_eixo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conteudo">{{ trans('cruds.conteudosCurriculare.fields.conteudo') }}</label>
                <input class="form-control {{ $errors->has('conteudo') ? 'is-invalid' : '' }}" type="text" name="conteudo" id="conteudo" value="{{ old('conteudo', $conteudosCurriculare->conteudo) }}">
                @if($errors->has('conteudo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conteudo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.conteudo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="analises_linguisticas">{{ trans('cruds.conteudosCurriculare.fields.analises_linguisticas') }}</label>
                <input class="form-control {{ $errors->has('analises_linguisticas') ? 'is-invalid' : '' }}" type="text" name="analises_linguisticas" id="analises_linguisticas" value="{{ old('analises_linguisticas', $conteudosCurriculare->analises_linguisticas) }}">
                @if($errors->has('analises_linguisticas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('analises_linguisticas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.analises_linguisticas_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.conteudosCurriculare.fields.recurso_didatico') }}</label>
                <select class="form-control {{ $errors->has('recurso_didatico') ? 'is-invalid' : '' }}" name="recurso_didatico" id="recurso_didatico">
                    <option value disabled {{ old('recurso_didatico', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ConteudosCurriculare::RECURSO_DIDATICO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('recurso_didatico', $conteudosCurriculare->recurso_didatico) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('recurso_didatico'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recurso_didatico') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.recurso_didatico_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.conteudosCurriculare.fields.situacao_didatica') }}</label>
                <select class="form-control {{ $errors->has('situacao_didatica') ? 'is-invalid' : '' }}" name="situacao_didatica" id="situacao_didatica">
                    <option value disabled {{ old('situacao_didatica', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ConteudosCurriculare::SITUACAO_DIDATICA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao_didatica', $conteudosCurriculare->situacao_didatica) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao_didatica'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao_didatica') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.conteudosCurriculare.fields.situacao_didatica_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conteudos_trabalhados">Conteúdos Trabalhados em Situação Didática</label>
                <textarea class="form-control ckeditor {{ $errors->has('conteudos_trabalhados') ? 'is-invalid' : '' }}" name="conteudos_trabalhados" id="conteudos_trabalhados">{!! old('conteudos_trabalhados', $conteudosCurriculare->conteudos_trabalhados) !!}</textarea>
                @if($errors->has('conteudos_trabalhados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conteudos_trabalhados') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="complementos_de_conteudo">Complementos De Conteúdo</label>
                <textarea class="form-control ckeditor {{ $errors->has('complementos_de_conteudo') ? 'is-invalid' : '' }}" name="complementos_de_conteudo" id="complementos_de_conteudo">{!! old('complementos_de_conteudo', $conteudosCurriculare->complementos_de_conteudo) !!}</textarea>
                @if($errors->has('complementos_de_conteudo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('complementos_de_conteudo') }}
                    </div>
                @endif
                <span class="help-block"></span>
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
                xhr.open('POST', '{{ route('admin.conteudos-curriculares.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $conteudosCurriculare->id ?? 0 }}');
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

function showDiv1(select){
   if(select.value=='CDP'){
    document.getElementById('cdp').style.display = "block";
   } else{
    document.getElementById('cdp').style.display = "none";
   }

   if(select.value=='BNCC'){
    document.getElementById('bncc').style.display = "block";
   } else{
    document.getElementById('bncc').style.display = "none";
   }
}

function showDiv2(select){
   if(select.value=='Ensino Infantil'){
    document.getElementById('disciplina').style.display = "none";
   } else{
    document.getElementById('disciplina').style.display = "block";
   }
}

</script>

@endsection
