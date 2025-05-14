@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Situação
    </div>

    <div class="card-body">

      <table class="table table-bordered table-striped table-hover datatable">
        <thead>
          <tr>
            <th> Usuário Da Biblioteca </th>
            <th> Biblioteca </th>
            <th> Data De Devolução </th>
            <th> Livro(s) </th>
          </tr>
        </thead>
        <tbody>
          @foreach($emprestimosEDevolucos as $emprestimos)
          <tr>
            <td> {{ $emprestimos->usuario_da_biblioteca->nome_completo }}</td>
            <td> {{ $emprestimos->biblioteca->nome_da_biblioteca }} </td>
            <td> {{ $emprestimos->data_de_devolucao }} </td>
            <td> @foreach($emprestimos->livros as $key => $livros) <span class="label label-info">{{ $livros->titulo }}</span> @endforeach </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <table class="table table-bordered table-striped table-hover datatable">
        <thead>
          <tr>
            <th> Situação: {{ App\Models\EmprestimosEDevoluco::SITUACAO_SELECT[$emprestimos->situacao] ?? '' }} </th>
          </tr>
        </thead>
      </table>

      @if($emprestimos->situacao != 'Devolvido' && $emprestimos->situacao != 'Devolvido com danos')

      <div class="card-up">

      <div class="card-op aprovar">
      <a class="check" href="{{ route("admin.emprestimos-e-devolucos.situacao-up") }}?id={{$id}}&situacao=Devolvido"
      onclick="if(confirm('Esta ação não poderá ser desfeita, tem certeza?')) document.getElementById('situacao-{{ $id }}').submit()">
      <i class="fas fa-check-circle"> </i> Confirmar Devolução
      </a>
      </div>

      @if($emprestimos->situacao != 'Prorrogado')

      <div class="card-op entregar">
      <a class="prorrogar" href="{{ route("admin.emprestimos-e-devolucos.situacao-up") }}?id={{$id}}&situacao=Prorrogado"
      onclick="if(confirm('A prorrogação deste registro poderá ser realizada apenas uma vez e o usuario terá 7 dias a mais para realizar a devolução.')) document.getElementById('situacao-{{ $id }}').submit()">
      <i class="fas fa-history"> </i> Prorrogar Devolução
      </a>
      </div>

      @endif

      <div class="card-op reprovar">
      <a class="check-d" href="{{ route("admin.emprestimos-e-devolucos.situacao-up") }}?id={{$id}}&situacao=Devolvido com danos"
      onclick="if(confirm('Esta ação não poderá ser desfeita, tem certeza?')) document.getElementById('situacao-{{ $id }}').submit()">
      <i class="fas fa-frown"> </i> Confirmar Devolução Com Danos
      </a>
      </div>

      </div>

      @endif

      </div>
      </div>

<style media="screen">

.card-up {
  display: flex;
  margin: 10px;
}

.card-op {
    margin: 10px;
}

a.check {
    color: #2eb85c;
}

a.prorrogar {
    color: #39f;
}

a.check-d {
    color: #ffa726;
}

</style>

@endsection
