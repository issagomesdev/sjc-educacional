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
            <th> Produtos </th>
            <th> Quantidades </th>
          </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $pedido)
          <tr>
            <td> {{ $pedido['produto_nome'] }} </td>
            <td> {{ $pedido['quantidade'] }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <table class="table table-bordered table-striped table-hover datatable">
        <thead>
          <tr>
            <th> Situação: @foreach($requisico as $requisico) {{ $requisico->situacao ?? 'Pendente' }} @endforeach</th>
          </tr>
        </thead>
      </table>

      <div class="card-up">

      <div class="card-op aprovar">
      <a class="aprovar" href="{{ route("admin.requisicos.situacao-up") }}?id={{$id}}&situacao=Aprovado">
      <i class="fas fa-check-circle"> </i> Aprovar
      </a>
      </div>

      <div class="card-op entregar">
      <a class="entregar" href="{{ route("admin.requisicos.situacao-up") }}?id={{$id}}&situacao=Entregue">
      <i class="fas fa-arrow-alt-circle-down"> </i> Entregar
      </a>
      </div>

      <div class="card-op reprovar">
      <a class="reprovar" href="{{ route("admin.requisicos.situacao-up") }}?id={{$id}}&situacao=Reprovado">
      <i class="fas fa-exclamation-circle"> </i> Reprovar
      </a>
      </div>

      <div class="card-op cancelar">
      <a class="cancelar" href="{{ route("admin.requisicos.situacao-up") }}?id={{$id}}&situacao=Cancelado">
      <i class="fas fa-times-circle"> </i> Cancelar
      </a>
      </div>

      </div>

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

a.aprovar {
    color: #2eb85c;
}

a.entregar {
    color: #39f;
}

a.reprovar {
    color: #e55353;
}

a.cancelar {
    color: #ffa726;
}

</style>

@endsection
