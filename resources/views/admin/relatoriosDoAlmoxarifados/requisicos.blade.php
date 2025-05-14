@extends('layouts.admin')
<title> Relatórios do Almoxarifado </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Requisições
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-requisicos">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Estoque </th>
           <th style="width: 50%;" aria-sort="none"> Requisitante </th>
           <th style="width: 50%;" aria-sort="none"> Situação </th>
           <th style="width: 50%;" aria-sort="none"> Data </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>
           <td>
             <select class="search">
               <option value>{{ trans('global.all') }}</option>
               @foreach($estoques as $key => $item)
                   <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
               @endforeach
           </select>
          </td>
           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($requisitantes as $key => $item)
                     <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                 @endforeach
             </select>
           </td>
           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 <option value="Pendente"> Pendente </option>
                 <option value="Aprovado"> Aprovado </option>
                 <option value="Entregue"> Entregue </option>
                 <option value="Reprovado"> Reprovado </option>
                 <option value="Cancelado"> Cancelado </option>
             </select>
           </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> </td>
         </tr>
       <tbody>
         @foreach($requisicoes as $requisicao)
         <td> </td>
         <td></td>
             <td>
                {{ $requisicao->estoque->titulo }}
             </td>
             <td>
                {{ $requisicao->requisitantes->nome }}
             </td>
             <td>
                {{ $requisicao->situacao ?? 'Pendente' }}
             </td>
             <td>
                {{ $requisicao->created_at }}
             </td>
               <td></td>
           </tr>
           @endforeach
       </tbody>
   </table>
</div>

<link rel="stylesheet" href="{{ url('reports/teams.css') }}">

<style media="screen">
.grapic {
  margin-bottom: 5rem;
}
</style>

@endsection
@section('scripts')
@parent

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-requisicos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>

@endsection
