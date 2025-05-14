@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.boletin.title') }}
    </div>

    <form method="GET" action="{{ route("admin.boletins.index") }}">
        @csrf

    <div class="card-body">
        <p>

          <div class="selecionar">
          <div class="option"> <span> Escola </span> </div>
           <select name="escola">
             <option value=""> Selecione por favor </option>
             @foreach($escola as $escola)
           <option value="{{ $escola->id }}" {{ (old('escola') ? old('escola') : $escola->id ?? '') == $request_escola ? 'selected' : '' }}> {{ $escola->name }} </option>
             @endforeach
           </select>
          </div>

          <div class="selecionar">
          <div class="option"> <span> Turma </span> </div>
           <select name="turma" id="turma">
             <option value=""> Selecione por favor </option>
             @foreach($turma as $turma)
           <option value="{{ $turma->id }}" {{ (old('turma') ? old('turma') : $turma->id ?? '') == $request_turma ? 'selected' : '' }}> {{ $turma->serie }} {{ $turma->identificacao }} </option>
             @endforeach
           </select>
          </div>

          <div class="selecionar">
          <div class="option"> <span> Ano </span> </div>
           <select name="ano">
             <option value=""> Selecione por favor </option>
             @foreach($ano as $ano)
           <option value="{{ $ano->ano }}" {{ (old('ano') ? old('ano') : $ano->ano ?? '') == $request_ano ? 'selected' : '' }}> {{ $ano->ano }} </option>
             @endforeach
           </select>
          </div>

          <div class="conteiner">
            <div class="form-btn">
                <input class="btn-next" type="submit" value="Proximo">
            </div>
          </div>
        </p>
    </div>
    </form>

<div class="alunos">

<table class=" table-sm table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
        <th height="10"> </th>
        </tr>
    </thead>
<tbody>
@foreach($alunos as $aluno)
<tr>
<td> </td>
<td height="100"> <span class="aluno"> {{ $aluno->nome_completo }} </span> </td>
<td> <a class="view" href="{{ route("admin.boletins.view") }}?aluno={{ $aluno->id }}&escola={{ $request_escola }}&turma={{ $request_turma }}&ano={{ $request_ano }}"> visualizar boletim </a> </td>

</tr>
@endforeach

</tbody>
</table>



</div>

</div>

<style media="screen">

.card-body {
    display: flex;
    flex-wrap: wrap;
}

.selecionar {
    margin: 5px;
}

.conteiner {
    margin-top: 28px;
    padding-left: 10px;
}


.alunos {
    margin: 25px;
}

.table-bordered, .table-bordered td, .table-bordered th {
    border: 0px solid;
    border-color: #d8dbe0;
}

.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 0px;
}

span.aluno {
    text-transform: uppercase;
    font-weight: 650;
    color: #525354;
}

a {
    text-decoration: none;
    text-transform: capitalize;
    font-weight: 450;
    background-color: #ed303000;
    color: #3c4b64;
}

/* * container-fluid * */

@media (min-width: 320px) and (max-width: 425px){
  .container-fluid[data-ativo='close'] {
      width: 95% !important;
      margin-right: auto;
      margin-left: 0px !important;
      margin-top: 9rem;
      transition: all 0.5s ease;
  }
}

@media (min-width: 768px) and (max-width: 768px){

  .container-fluid[data-ativo='close'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: -10px !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
}

}

@media (min-width: 1024px) and (max-width: 1024px) {
.container-fluid[data-ativo='close'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: 0 !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
  }

  .container-fluid[data-ativo='open'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: -10px !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
}
}

@media (min-width: 1440px) {
.container-fluid[data-ativo='close'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: 0 !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
  }

  .container-fluid[data-ativo='open'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: -10px !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
}
}

</style>

@endsection
