@extends('layouts.admin')
<title> Relatórios do Almoxarifado </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios dos Requisitantes
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-requisitantes">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Nome </th>
           <th style="width: 50%;" aria-sort="none"> Estado </th>
           <th style="width: 50%;" aria-sort="none"> Cidade </th>
           <th style="width: 50%;" aria-sort="none"> Situação </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td> <select class="search" strict="true">
               <option value>{{ trans('global.all') }}</option>
               <option value="Não atribuido">Não atribuido</option>
               @foreach(App\Models\Requisitante::ESTADO_SELECT as $key => $item)
                   <option value="{{ $item }}">{{ $item }}</option>
               @endforeach
           </select> </td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td> <select class="search" strict="true">
               <option value>{{ trans('global.all') }}</option>
               @foreach(App\Models\Requisitante::SITUACAO_SELECT as $key => $item)
                   <option value="{{ $item }}">{{ $item }}</option>
               @endforeach
              </select> </td>
           <td> </td>
         </tr>
       <tbody>
         @foreach($requisitantes as $requisitante)
         <td> </td>
         <td></td>
             <td>
                {{ $requisitante->nome ?? 'Não atribuido' }}
             </td>
               <td>
                 {{ App\Models\Requisitante::ESTADO_SELECT[$requisitante->estado] ?? 'Não atribuido' }}
               </td>
               <td>
                 {{ $requisitante->cidade ?? 'Não atribuido' }}
               </td>
               <td>
                 {{ App\Models\Requisitante::SITUACAO_SELECT[$requisitante->situacao] ?? 'Ativo' }}
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
  let table = $('.datatable-requisitantes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
