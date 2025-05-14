@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-body">
      <div class="form-group">
          <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
              {{ trans('global.back_to_list') }}
          </a>
      </div>

        <form method="POST" action="{{ route("admin.presenca-eletivas.store") }}" enctype="multipart/form-data">
            @csrf
              <input type="hidden" class="escola_id" value="{{$escola}}" for="escola_id" name="escola_id">
              <input type="hidden" class="turma_id" value="{{$turma}}" for="turma_id" name="turma_id">
              <input type="hidden" class="ano" value="{{$ano}}" for="ano" name="ano">
            <div class="contein1">

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
            <div class="form-group">
                <label class="required" for="data">{{ trans('cruds.presencaEletiva.fields.data') }}</label>
                <input class="form-control date {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data') }}" required>
                @if($errors->has('data'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presencaEletiva.fields.data_helper') }}</span>
            </div>
            @foreach($turmav as $turma)
            @if( $turma->nivel_da_turma == 'Ensino Infantil') @else
            <div class="form-group">
                <label class="required" for="disciplina_id"> Disciplina </label>
                <select class="form-control selectd" name="disciplina_id" id="disciplina_id" required>
                    @foreach($disciplinas as $id => $entry)
                        <option value="{{ $id }}" {{ old('disciplina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            @endif
            @endforeach
            </div>

            <div class="table-responsive">
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>

                                <th style="width: 5%"> </th>
                                <th style="width: 35%">Alunos</th>
                                <th style="width: 10%">Presente</th>
                                <th style="width: 10%">FNJ</th>
                                <th style="width: 10%">FJ</th>
                                <th style="width: 35%">Motivo</th>

                        </tr>
                    </thead>
            <tbody>
              @foreach($alunos as $aluno)
              <tr>
                <td> </td>
                  <td>
                      <input type="hidden" class="aluno" value="{{ $aluno->id }}" for="aluno_id" name="aluno_{{ $aluno->id }}[]">
                     {{ $aluno->nome_completo }}
                  </td>

                         <td><input type="radio" value="P" id="P_{{ $aluno->id }}" name="pxf_{{ $aluno->id }}[]" onchange="p_{{ $aluno->id }}()" checked></td>
                         <td><input type="radio" value="FNJ" id="FNJ_{{ $aluno->id }}" name="pxf_{{ $aluno->id }}[]" onchange="fnj_{{ $aluno->id }}()"></td>
                         <td><input type="radio" value="FJ" id="FJ_{{ $aluno->id }}" name="pxf_{{ $aluno->id }}[]" onchange="fj_{{ $aluno->id }}()"></td>

              <td>
              <div class="Motivo" id="motivo_{{ $aluno->id }}" style="display:none;">
                <select class="form-control2" name="selecionar_motivo_{{ $aluno->id }}[]" id="selecionar_motivo_{{ $aluno->id }}">
                    <option value=""> Informe Motivo </option>
                    <option value="AM"> AM </option>
                    <option value="DC"> DC </option>
                    <option value="DP"> DP </option>
                    <option value="EA"> EA </option>
                    <option value="EG"> EG </option>
                    <option value="ET"> ET </option>
                    <option value="FTE"> FTE </option>
                    <option value="OCO"> OCO </option>
                    <option value="PAND"> PAND </option>
                </select>
              </div>
              </td>
              </tr>

              @section('scripts')
              @parent
              <script type="text/javascript">

              function p_{{ $aluno->id }}(){
                document.getElementById('motivo_{{ $aluno->id }}').style.display ='none';
              }

              function fnj_{{ $aluno->id }}(){
                document.getElementById('motivo_{{ $aluno->id }}').style.display ='none';
              }

              function fj_{{ $aluno->id }}(){
                document.getElementById('motivo_{{ $aluno->id }}').style.display = 'block';
              }

              </script>
              @endsection

                @endforeach
              </tbody>
               </table>
           </div>
           <input type="hidden" class="user_id" value="{{Auth::user()->id}}" for="user_id" name="user_id">
           <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">

            <div class="form-btn">
                <input class="btn btn-add" type="submit" value="Adicionar">
            </div>
        </form>
    </div>
</div>

<style>
@media (max-width: 380px) {

.contein1 {
  width: auto;
  display: flex;
  flex-wrap: wrap !important;
  align-content: center !important;
  justify-content: flex-start !important;
  flex-direction: column !important;
}
}

@media (min-width: 1024px){

  .container-fluid[data-ativo='close'] {
      width: 100% !important;
      margin-right: auto;
      margin-left: 0 !important;
      margin-top: 5rem !important;
      transition: all 0.5s ease;
  }

.container-fluid[data-ativo='open'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: 0 !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
}

 }

 .container-fluid {
     margin-top: 5rem !important;
 }

li {
    list-style: none;
}

.table-bordered, .table-bordered td, .table-bordered th {
    border: 0px solid;
    border-color: #d8dbe0;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    margin-bottom: 1.5rem;
    word-wrap: break-word;
    background-clip: border-box;
    border: 0px solid;
    border-radius: .25rem;
    background-color: #fff0;
    border-color: #d8dbe0;
}

.form-control {
    display: block;
    width: 90%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    background-clip: padding-box;
    border: 1px solid;
    color: #768192;
    background-color: #fff;
    border-color: #d8dbe0;
    border-radius: 0rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.form-control2 {
    display: block;
    width: 90%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    background-clip: padding-box;
    border: 1px solid;
    color: #768192;
    background-color: #fff;
    border-color: #d8dbe0;
    border-radius: 0rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.form-group {
    margin-bottom: 1rem;
    margin-left: -0.8rem;
}

.form-btn {
    margin-top: -20px;
    position: absolute;
    right: 0;
}

.btn-default {
    color: #fff;
    background-color: #545bb5;
    border-color: #545bb5;
}

.btn-default:hover {
    color: #fff;
    background-color: #424c9b;
    border-color: #424c9b;
}

.btn-default:not(:disabled):not(.disabled):active, .btn-default:not(:disabled):not(.disabled).active, .show>.btn-default.dropdown-toggle {
    color: #fff;
    background-color: #424c9b;
    border-color: #424c9b;
}

.table-responsive {
    margin: 50px 0px 50px 0px;
}

.select2 {
    max-width: 100%;
    width: 100% !important;
}

.contein1 {
    width: auto;
    display: flex;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    flex-direction: row;
}

.contein0 {
    width: auto;
    display: flex;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    flex-direction: row;
}

html:not([dir=rtl]) .form-check-input {
    margin-left: 1.2px;
}

input.btn.btn-subs {
    color: #fff;
    background-color: #e55353;
    border-color: #e55353;
}

input.btn.btn-add {
    color: #fff;
    background-color: #2eb85c;
    border-color: ##2eb85c;
}

input.btn.btn-search {
    color: #fff;
    background-color: #39f;
    border-color: #39f;
}

@media only screen
   and (max-device-width: 800px) {

.form-group {
    margin-bottom: 1rem;
    margin-left: -5px;
}

}

</style>

@endsection
