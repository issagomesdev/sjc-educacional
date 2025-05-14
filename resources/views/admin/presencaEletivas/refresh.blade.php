@extends('layouts.admin')
@section('content')


<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>

<div class="card-body infos">

 @foreach($escola as $escola)
<strong> Escola: </strong>   <td> {{$escola->name}} </td>
 @endforeach
 <br>
 @foreach($turma as $turma)
<strong> Turma: </strong> <td> {{$turma->serie}} </td>
 @endforeach
 <br>
 @foreach($ano as $a)
<strong> Data: </strong> <td> {{$data}}/{{$a->ano}} </td>
 @endforeach
@foreach($disciplina as $disciplina)
<br>
<strong> Disciplina: </strong> <td> {{$disciplina->nome_da_materia}} </td>
@endforeach
 <br>
<strong> Bimestre: </strong> <td> {{ App\Models\PresencaEletiva::BIMESTRE_SELECT[$bimestre] ?? '' }} </td>

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

    @foreach($presencaEletivas as $presencaEletiva)
    <form method="POST" action="{{ route("admin.presenca-eletivas.update", [$presencaEletiva]) }}" enctype="multipart/form-data">
      @method('PUT')
      @csrf

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <tr>
      <td> </td>
        <td>
            <input type="hidden" class="aluno" value="{{ $presencaEletiva->alunos->id }}" for="aluno_id" name="aluno_{{ $presencaEletiva->alunos->id }}[]">
           {{ $presencaEletiva->alunos->nome_completo }}
        </td>

               <td><input type="radio" value="P" id="P_{{ $presencaEletiva->alunos->id }}" name="pxf_{{ $presencaEletiva->alunos->id }}[]" onchange="p_{{ $presencaEletiva->alunos->id }}()" {{ $presencaEletiva->selecione_falta === (string) 'P' ? 'checked' : '' }}></td>
               <td><input type="radio" value="FNJ" id="FNJ_{{ $presencaEletiva->alunos->id }}" name="pxf_{{ $presencaEletiva->alunos->id }}[]" onchange="fnj_{{ $presencaEletiva->alunos->id }}()" {{ $presencaEletiva->selecione_falta === (string) 'FNJ' ? 'checked' : '' }}></td>
               <td><input type="radio" value="FJ" id="FJ_{{ $presencaEletiva->alunos->id }}" name="pxf_{{ $presencaEletiva->alunos->id }}[]" onchange="fj_{{ $presencaEletiva->alunos->id }}()" {{  $presencaEletiva->selecione_falta === (string) 'FJ' ? 'checked' : '' }}></td>


    <td>

    <div class="Motivo" id="motivo_{{ $presencaEletiva->alunos->id }}" @if( $presencaEletiva->selecione_falta == 'FJ') @else style="display:none;" @endif>
      <select class="form-control2" name="selecionar_motivo_{{ $presencaEletiva->alunos->id }}[]" id="selecionar_motivo_{{ $presencaEletiva->alunos->id }}">
          <option value=""> Informe Motivo </option>
          <option value="AM" {{ $presencaEletiva->selecionar_motivo === (string) 'AM' ? 'selected' : '' }}> AM </option>
          <option value="DC" {{ $presencaEletiva->selecionar_motivo === (string) 'DC' ? 'selected' : '' }}> DC </option>
          <option value="DP" {{ $presencaEletiva->selecionar_motivo === (string) 'DP' ? 'selected' : '' }}> DP </option>
          <option value="EA" {{ $presencaEletiva->selecionar_motivo === (string) 'EA' ? 'selected' : '' }}> EA </option>
          <option value="EG" {{ $presencaEletiva->selecionar_motivo === (string) 'EG' ? 'selected' : '' }}> EG </option>
          <option value="ET" {{ $presencaEletiva->selecionar_motivo === (string) 'ET' ? 'selected' : '' }}> ET </option>
          <option value="FTE" {{ $presencaEletiva->selecionar_motivo === (string) 'FTE' ? 'selected' : '' }}> FTE </option>
          <option value="OCO" {{ $presencaEletiva->selecionar_motivo === (string) 'OCO' ? 'selected' : '' }}> OCO </option>
          <option value="PAND" {{ $presencaEletiva->selecionar_motivo === (string) 'PAND' ? 'selected' : '' }}> PAND </option>
      </select>
    </div>
    </td>
    </tr>


    <script type="text/javascript">

    function p_{{ $presencaEletiva->alunos->id }}(){
      document.getElementById('motivo_{{ $presencaEletiva->alunos->id }}').style.display ='none';
    }

    function fnj_{{ $presencaEletiva->alunos->id }}(){
      document.getElementById('motivo_{{ $presencaEletiva->alunos->id }}').style.display ='none';
    }

    function fj_{{ $presencaEletiva->alunos->id }}(){
      document.getElementById('motivo_{{ $presencaEletiva->alunos->id }}').style.display = 'block';
    }

    </script>

      @endforeach

    </tbody>
     </table>
 </div>
           @if(is_countable($presencaEletivas) && count($presencaEletivas) == 0)
           <div class="sregistros">
             <p class="mensage"> Não há registros de comparecimento para a turma selecionada, da escola selecionada, na data selecionada, para a disciplina selecionada e no bimestre selecionado, verifique se houve algum erro de preenchimento e tente novamente. </p>
           </div>
           @else
           </tr>
            <div class="form-btn">
                <input class="btn btn-add" type="submit" value="Salvar">
            </div>
            @endif
        </form>
    </div>
</div>

<style>

.container-fluid {
    margin-top: 9rem !important;
}

@media (min-width: 320px) and (max-width: 1200px){
.container-fluid[data-ativo='close'] {
    width: 100%;
    margin-right: auto;
    margin-left: -10px;
    margin-top: 9rem;
    transition: all 0.5s ease;
}
 }

.form-btn {
    padding: 2rem;
    position: relative;
    right: 0;
}

.table-bordered, .table-bordered td, .table-bordered th {
    border: 0px solid;
    border-color: #d8dbe0;
}

p.mensage {
    padding-top: 5px;
}
.sregistros {
    position: relative;
    width: 100%;
    height: 80px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    left: 0;
    right: 0;
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
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.form-control2 {
    display: block;
    width: 80%;
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
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
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
    margin: 0px 0px 20px 0px;
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

</style>



@endsection
