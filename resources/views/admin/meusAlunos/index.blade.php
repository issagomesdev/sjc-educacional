@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.meusAluno.title') }}
    </div>

    <div class="card-body">

   <div class="selecionar">
    <span>Escolhe uma das suas turmas para ter seus alunos listados</span>
    <select name="forma" onchange="location = this.value;">
      <option> Selecione </option>
      @foreach($turma as $turma)
    <option value="{{ route('admin.meus-alunos.index') }}?id_turma={{$turma->id}}"><a href=""> {{ $turma->ano_serie }} </a></option>
      @endforeach
    </select>
   </div>

 <div class="alunos">
    @if($turmid == null) @else
    <ul id=stocksymbols>
      @foreach($alunos as $alunos)
           <li> {{ $alunos->nome_completo }} </li>
           @endforeach
    @endif
    </ul>

  </div>




    </div>
</div>

<script type="text/javascript">

function sortList(ul) {
  var ul = document.getElementById(ul);

  Array.from(ul.getElementsByTagName("LI"))
    .sort((a, b) => a.textContent.localeCompare(b.textContent))
    .forEach(li => ul.appendChild(li));
}

sortList("stocksymbols");

</script>

<style media="screen">

.alunos {
  margin-top: 30px;
}

ul {
    list-style: number;
}

</style>


@endsection
