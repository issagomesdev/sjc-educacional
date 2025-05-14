@extends('layouts.admin')
@section('content')

@foreach($turma as $turma) @endforeach
@if( $turma->nivel_da_turma == 'Ensino Infantil')

    <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
    <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
    <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
    <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
    <div class="table-responsive">

      <div class="form-aluno">
          <label class="required" for="aluno_id"> Selecione um aluno para ver seu registro correspondente. </label>
          <select class="form-control selectd" name="aluno_id" id="aluno_id" onchange="location = this.value;" required>
            <option value="">Selecione por favor</option>
              @foreach($alunos as $aluno)
                  <option value="{{ route('admin.nota.view-inf') }}?aluno={{$aluno->id}}&bimestre={{$request_bimestre}}&escola={{$request_escola}}&turma={{$request_turma}}&ano={{$request_ano}}"><a href=""> {{ $aluno->nome_completo }} </a></option>
              @endforeach
          </select>
          </div>

          </div>
<style media="screen">

input.btn.btn-next {
    color: #fff;
    background-color: #768192;
    border-color: #768192;
}

.form-aluno {
    margin-left: auto;
    padding-left: 0;
    margin-right: auto;
    width: 600px;
}

</style>

@else

<div class="card">
  <div class="card-header">
      Registro de Notas
    </div>

<div class="form-group">
    <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>

<div class="card-body">
  @foreach($escola as $escola)
 <strong> Escola: </strong> <td> {{ $escola->name }} </td>
  @endforeach
 <br>
 <strong> Turma: </strong> <td> {{ $turma->serie }} {{ $turma->identificacao }} </td>
 <br>
  @foreach($disciplina as $disciplina)
 <strong> Disciplina: </strong> <td> {{ $disciplina->nome_da_materia }} </td>
  @endforeach
 <br>
 <strong> Bimestre: </strong> <td> {{ App\Models\Notum::BIMESTRE_SELECT[$request_bimestre] ?? '' }} </td>
</div>

@if($request_bimestre == 'NRF')

<div class="card-body">
        <div class="table-responsive">
          @if(is_countable($notum) && count($notum) == 0)
          <div class="sregistros">
            <p class="mensage"> Não há registros de notas na escola selecionada, para a turma selecionada, na disciplina, ano e bimestre selecionado, verifique se houve algum erro de preenchimento e tente novamente. </p>
          </div>
          @else
            <table class=" table-sm table-bordered table-striped table-hover datatable">
              <thead>
                <tr>
                  <th> </th>
                  <th>Aluno</th>
                  <th>1ª Unidade</th>
                  <th>2ª Unidade</th>
                  <th>3ª Unidade</th>
                  <th>4ª Unidade</th>
                  <th>Média Anual</th>
                  <th>Nota da Rec. Final</th>
                  <th> Nº de Faltas </th>
                </tr>
              </thead>
        <tbody>

          @foreach($alunos as $aluno)
          <tr>

            @foreach($unidade1 as $n1) @if($aluno->id == $n1->aluno_id) <?php if(abs($n1->mb > $n1->rec)) { $nota1 = $n1->mb; } else { $nota1 = $n1->rec; } ?> @endif @endforeach
            @foreach($unidade2 as $n2) @if($aluno->id == $n2->aluno_id) <?php if(abs($n2->mb > $n2->rec)) { $nota2 = $n2->mb; } else { $nota2 = $n2->rec; } ?> @endif @endforeach
            @foreach($unidade3 as $n3) @if($aluno->id == $n3->aluno_id) <?php if(abs($n3->mb > $n3->rec)) { $nota3 = $n3->mb; } else { $nota3 = $n3->rec; } ?> @endif @endforeach
            @foreach($unidade4 as $n4) @if($aluno->id == $n4->aluno_id) <?php if(abs($n4->mb > $n4->rec)) { $nota4 = $n4->mb; } else { $nota4 = $n4->rec; } ?> @endif @endforeach
            <?php $div = 4; $total = ($nota1 + $nota2 + $nota3 + $nota4) / $div; ?>

              <td> </td>
              <td> {{ $aluno->nome_completo }} </td>
              <td> @foreach($unidade1 as $u1) @if($aluno->id == $u1->aluno_id) {{ $u1->mb }} @endif @endforeach </td>
              <td> @foreach($unidade2 as $u2) @if($aluno->id == $u2->aluno_id) {{ $u2->mb }} @endif @endforeach </td>
              <td> @foreach($unidade3 as $u3) @if($aluno->id == $u3->aluno_id) {{ $u3->mb }} @endif @endforeach </td>
              <td> @foreach($unidade4 as $u4) @if($aluno->id == $u4->aluno_id) {{ $u4->mb }} @endif @endforeach </td>
              <td> <?php echo round($total, 2) ?> </td>
              <td> @foreach($mrecf as $m) @if($aluno->id == $m->aluno_id) {{ $m->mrecf ?? '0.00' }} @endif @endforeach </td>
              <td> {{ $aluno->faltas->count(); }} </td>
            </tr>

@endforeach
          </tbody>
           </table>
           </div>
           @endif

@else


    <div class="card-body">
            <div class="table-responsive">
              @if(is_countable($notum) && count($notum) == 0)
              <div class="sregistros">
                <p class="mensage"> Não há registros de notas na escola selecionada, para a turma selecionada, na disciplina, ano e bimestre selecionado, verifique se houve algum erro de preenchimento e tente novamente. </p>
              </div>
              @else
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                  <thead>
                      <tr>
                        <th> </th>
                        <th>Aluno</th>
                        <th>1ª AT</th>
                        <th>2ª AT</th>
                        <th>3ª AT</th>
                        <th>4ª AT</th>
                        <th>5ª AT</th>
                        <th>1ª Nota</th>
                        <th>2ª Nota</th>
                        <th>M. B.</th>
                        <th> Rec. {{ App\Models\Notum::BIMESTRE_SELECT[$request_bimestre] ?? '' }} </th>
                      </tr>
                  </thead>
            <tbody>

              @foreach($notum as $notum)
              <tr>

                  <td> </td>
                  <td> {{ $notum->alunos->nome_completo }} </td>
                  <td> {{ $notum->at1 ?? '0.00'}} </td>
                  <td> {{ $notum->at2 ?? '0.00'}} </td>
                  <td> {{ $notum->at3 ?? '0.00'}} </td>
                  <td> {{ $notum->at4 ?? '0.00'}} </td>
                  <td> {{ $notum->at5 ?? '0.00'}} </td>
                  <td> {{ $notum->nota1 ?? '0.00'}} </td>
                  <td> {{ $notum->nota2 ?? '0.00'}} </td>
                  <td> {{ $notum->mb ?? '0.00'}} </td>
                  <td> {{ $notum->rec ?? '0.00'}} </td>
                </tr>

@endforeach
              </tbody>
               </table>
               </div>

               </div>

               <div class="form-group">
                   <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
                       {{ trans('global.back_to_list') }}
                   </a>
               </div>
             </div>

@endif
@endif
@endif


<style>

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
