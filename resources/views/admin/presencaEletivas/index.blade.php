@extends('layouts.admin')
@section('content')

<!-- Adicionar -->

@if(is_countable($anos_letivos_abertos) && count($anos_letivos_abertos) == 0) @else
@can('presenca_eletiva_create')

<div class="card1">
    <div class="card-body">
        <form method="GET" action="{{ route("admin.presenca-eletivas.create") }}">
            @csrf

            <div class="contein2">

            <div class="form-group">
                <label class="required" for="escola_id">{{ trans('cruds.presencaEletiva.fields.escola') }}</label>
                <select class="form-control selectd" name="escola_id" id="escola_id" required>
                    @foreach($escola as $id => $entry)
                        <option value="{{ $id }}">{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
              <label class="required" for="ano">Ano</label>
              <select class="form-control selectd" name="ano" id="ano" required>
                <option value="">Selecione por favor</option>
                  @foreach($anos_letivos_abertos as $ano_aberto)
                      <option value="{{ $ano_aberto['ano'] }}">{{ $ano_aberto['ano'] }}</option>
                  @endforeach
              </select>
          </div>

            <div class="form-group">
                <label class="required" for="turma_id">{{ trans('cruds.presencaEletiva.fields.turmas') }}</label>
                <select class="form-control selectd" name="turma_id" id="turma_id" required>
                  <option value="">Selecione por favor</option>
                    @foreach($turmas as $tur)
                        <option value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }} {{ $tur->identificacao }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            </div>

            <div class="contein3">
              <div class="form-btn">
                  <input class="btn btn-import" type="submit" value="Adicionar Novo Registro">
              </div>
            </div>

        </form>
    </div>
</div>

@endcan

<!-- Atualizar -->

<div class="contein4">

@can('presenca_eletiva_edit')

<div class="card2">
    <div class="card-body">
      <form method="GET" action="{{ url('admin/presenca-eletivas/refresh') }}">
          @csrf

          <div class="contein2">

          <div class="form-group">
              <label class="required" for="escola_id">{{ trans('cruds.presencaEletiva.fields.escola') }}</label>
              <select class="form-control selectd" name="escola_id" id="escola_id" required>
                  @foreach($escola as $id => $entry)
                      <option value="{{ $id }}">{{ $entry }}</option>
                  @endforeach
              </select>
              <span class="help-block"> </span>
          </div>

          <div class="form-group">
            <label class="required" for="ano">Ano</label>
            <select class="form-control selectd" name="ano" id="ano" required>
              <option value="">Selecione por favor</option>
              @foreach($anos_letivos_abertos as $ano_aberto)
                  <option value="{{ $ano_aberto['ano'] }}">{{ $ano_aberto['ano'] }}</option>
              @endforeach
            </select>
        </div>

          </div>

          <div class="contein1">

              <div class="form-group">
                  <label class="required" for="turma_id">{{ trans('cruds.presencaEletiva.fields.turmas') }}</label>
                  <select class="form-control selectd" name="turma_id" id="turma-edit" required>
                    <option data-nivel="please" value="">Selecione por favor</option>
                      @foreach($turmas as $tur)
                          <option data-nivel="{{ $tur->nivel_da_turma }}" value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }} {{ $tur->identificacao }}</option>
                      @endforeach
                  </select>
                  <span class="help-block"> </span>
              </div>


          <div class="form-group">
              <label class="required" for="data">{{ trans('cruds.presencaEletiva.fields.data') }}</label>
              <input class="form-control date {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data') }}" required>
              <span class="help-block"> </span>
          </div>
          </div>

          <div class="contein1">

          <div class="form-group" id="disciplina-edit">
              <label class="required" for="disciplina_id">{{ trans('cruds.presencaEletiva.fields.disciplina') }}</label>
              <select class="form-control selectd" name="disciplina_id" id="disciplina_s-edit" required>
                  @foreach($disciplinas as $id => $entry)
                      <option value="{{ $id }}" {{ old('disciplina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                  @endforeach
              </select>
              <span class="help-block"> </span>
          </div>

          <div class="form-group">
              <label class="required">{{ trans('cruds.presencaEletiva.fields.bimestre') }}</label>
              <select class="form-control" name="bimestre" id="bimestre" required>
                  <option value disabled {{ old('bimestre', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                  @foreach(App\Models\PresencaEletiva::BIMESTRE_SELECT as $key => $label)
                      <option value="{{ $key }}" {{ old('bimestre', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                   @endforeach
              </select>
              <span class="help-block"> </span>
          </div>
          </div>

          <div class="contein3">
            <div class="form-btn">
                <input class="btn btn-edit" type="submit" value="Atualizar Registro Existente">
            </div>
          </div>

      </form>
    </div>
</div>

@endcan
@endif

<!-- vizualizar -->

  @can('presenca_eletiva_show')

<div class="card3">
    <div class="card-body">
      <form method="GET" action="{{ url('admin/presenca-eletivas/view') }}">
          @csrf

          <div class="contein2">

          <div class="form-group">
              <label class="required" for="escola_id">{{ trans('cruds.presencaEletiva.fields.escola') }}</label>
              <select class="form-control selectd" name="escola_id" id="escola_id" required>
                  @foreach($escola as $id => $entry)
                      <option value="{{ $id }}">{{ $entry }}</option>
                  @endforeach
              </select>
              <span class="help-block"> </span>
          </div>

          <div class="form-group">
            <label class="required" for="ano">Ano</label>
            <select class="form-control selectd" name="ano" id="ano" required>
              <option value="">Selecione por favor</option>
              @foreach($anos_letivos as $anos)
                  <option value="{{ $anos['ano'] }}">{{ $anos['ano'] }}</option>
              @endforeach
            </select>
        </div>

    </div>

          <div class="contein1">

            <div class="form-group">
                <label class="required" for="turma_id">{{ trans('cruds.presencaEletiva.fields.turmas') }}</label>
                <select class="form-control selectd" name="turma_id" id="turma-view" required>
                  <option data-nivel="please" value="">Selecione por favor</option>
                    @foreach($turmas as $tur)
                        <option data-nivel="{{ $tur->nivel_da_turma }}" value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }} {{ $tur->identificacao }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

          <div class="form-group">
              <label class="required" for="data">{{ trans('cruds.presencaEletiva.fields.data') }}</label>
              <input class="form-control date {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data') }}" required>
              <span class="help-block"> </span>
          </div>

          </div>

          <div class="contein1">

          <div class="form-group" id="disciplina-view">
              <label class="required" for="disciplina_id">{{ trans('cruds.presencaEletiva.fields.disciplina') }}</label>
              <select class="form-control selectd" name="disciplina_id" id="disciplina_s-view" required>
                  @foreach($disciplinas as $id => $entry)
                      <option value="{{ $id }}" {{ old('disciplina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                  @endforeach
              </select>
              <span class="help-block"> </span>
          </div>

          <div class="form-group">
              <label class="required">{{ trans('cruds.presencaEletiva.fields.bimestre') }}</label>
              <select class="form-control {{ $errors->has('bimestre') ? 'is-invalid' : '' }}" name="bimestre" id="bimestre" required>
                  <option value disabled {{ old('bimestre', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                  @foreach(App\Models\PresencaEletiva::BIMESTRE_SELECT as $key => $label)
                      <option value="{{ $key }}" {{ old('bimestre', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                  @endforeach
              </select>
              <span class="help-block"> </span>
          </div>

          </div>

          <div class="contein3">
            <div class="form-btn">
                <input class="btn btn-view" type="submit" value="Visualizar Registro Existente">
            </div>
          </div>
      </form>


@endcan
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ url('css/response.css') }}">
<link rel="stylesheet" href="{{ url('resources/presenca-eletivas.css') }}">

@endsection
@section('scripts')
@parent

<script>

$(document).ready(function () {
    toggleFields_edit();
    $("#turma-edit").change(function () {
        toggleFields_edit();
    });
});

function toggleFields_edit() {
    if ($("#turma-edit option:selected").data('nivel') == 'Ensino Infantil' || $("#turma-edit option:selected").data('nivel') == 'please' ) {
        $("#disciplina-edit").hide();
        $("select#disciplina_s-edit").removeAttr('required');
        $("select#disciplina_s-edit").attr('disabled', 1);
    } else {
        $("#disciplina-edit").show();
        $("select#disciplina_s-edit").removeAttr('disabled');
        $("select#disciplina_s-edit").attr('required', 1);
    }
}

</script>

<script>

$(document).ready(function () {
    toggleFields_view();
    $("#turma-view").change(function () {
        toggleFields_view();
    });
});

function toggleFields_view() {
    if ($("#turma-view option:selected").data('nivel') == 'Ensino Infantil' || $("#turma-view option:selected").data('nivel') == 'please' ) {
        $("#disciplina-view").hide();
        $("select#disciplina_s-view").removeAttr('required');
        $("select#disciplina_s-view").attr('disabled', 1);
    } else {
        $("#disciplina-view").show();
        $("select#disciplina_s-view").removeAttr('disabled');
        $("select#disciplina_s-view").attr('required', 1);
    }
}

</script>

@endsection
