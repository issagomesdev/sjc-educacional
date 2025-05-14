@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-header">
      Registro de Comparecimento
    </div>

<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>

<div class="lab">

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




    <div class="card-body">
            <div class="table-responsive">
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                                <th style="width: 35%">Alunos</th>
                                <th style="width: 30%">Comparecimento</th>
                                <th style="width: 35%">Motivo</th>

                        </tr>
                    </thead>
            <tbody>
              @foreach($presencaEletivas as $presencaEletiva)
              <tr>
                <fieldset id="alunos">
                  <td> {{ $presencaEletiva->alunos->nome_completo }} </td>
                  <input type="hidden" class="alunos" value="{{ $presencaEletiva->alunos_id }}" for="alunos_id" name="aluno[]">
                </fieldset>

                       <fieldset id="pxf">
                         <td>{{ App\Models\PresencaEletiva::SELECIONE_FALTA_RADIO[$presencaEletiva->selecione_falta] ?? '' }} </td>
                      </fieldset>

                <td>{{ $presencaEletiva->selecionar_motivo ?? 'Não Atribuido'}}</td>

                @endforeach
              </tbody>
               </table>
               </div>


               <div class="sregistros">
                 <p class="mensage">
                   @if(is_countable($presencaEletivas) && count($presencaEletivas) == 0)
                   Não há registros de comparecimento para a turma selecionada, da escola selecionada, na data selecionada, para a disciplina selecionada e no bimestre selecionado, verifique se houve algum erro de preenchimento e tente novamente.

                   @else

                   Adicionado em {{ $presencaEletiva->created_at ?? '' }} por {{ $presencaEletiva->assinatura->name ?? 'Autor' }} de {{ $presencaEletiva->team->name ?? '' }}
                   @endif
                   </p>
               </div>

               </div>
            </div>
</div>

<style>

.container-fluid {

    margin-bottom: 2rem !important;
    width: 100% !important;
    margin-right: auto;
    margin-left: -15px;
    margin-top: 9rem;
    transition: all 0.5s ease;
    position: relative;
}

@media (min-width: 320px) and (max-width: 1024px){
.container-fluid[data-ativo='close'] {

  margin-left: -10px;
}
}

.lab {
    padding-left: 25px;
    padding-top: 10px;
}

p.mensage {
    padding-top: 5px;
}
.sregistros {
    width: 100%;
    height: 80px;
    top: -20px;
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
    width: 100%;
    margin-bottom: 0rem;
    word-wrap: break-word;
    background-clip: border-box;
    border: 1px solid;
    border-radius: .25rem;
    background-color: #fff;
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

.form-group {
    margin-bottom: 1rem;
    margin-top: 1rem;
    margin-left: 1rem;
}

.form-btn {
    margin-top:2rem;
    margin-left: 1rem;
}

.btn-default {
    color: #23282c;
    background-color: #f0f3f5;
    border-color: #f0f3f5;
}

.btn:not(:disabled):not(.disabled) {
    cursor: pointer;

}

.table-responsive {
    margin: 5px 0px 0px 0px;
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
