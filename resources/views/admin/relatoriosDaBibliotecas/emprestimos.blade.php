@extends('layouts.admin')
<title> Relatórios de Empréstimo de Livro </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Empréstimo de Livro
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-emprestimos">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Usuário Da Biblioteca </th>
           <th style="width: 50%;" aria-sort="none"> Biblioteca </th>
           <th style="width: 50%;" aria-sort="none"> Livro(s) </th>
           <th style="width: 50%;" aria-sort="none"> Data De Devolução </th>
           <th style="width: 50%;" aria-sort="none"> Situação </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>

           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($usuarios_da_bibliotecas as $key => $item)
                     <option value="{{ $item->nome_completo }}">{{ $item->nome_completo }}</option>
                 @endforeach
             </select>
           </td>

           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($cadastrar_bibliotecas as $key => $item)
                     <option value="{{ $item->nome_da_biblioteca }}">{{ $item->nome_da_biblioteca }}</option>
                 @endforeach
             </select>
           </td>

           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($cadastrar_livros as $key => $item)
                     <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                 @endforeach
             </select>
           </td>

           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>

           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\EmprestimosEDevoluco::SITUACAO_SELECT as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>
           <td> </td>
         </tr>
       <tbody>
       @foreach($emprestimos as $emprestimo)
         <td> </td>
         <td></td>
             <td> {{ $emprestimo->usuario_da_biblioteca->nome_completo }} </td>
             <td> {{ $emprestimo->biblioteca->nome_da_biblioteca }} </td>
             <td> @foreach($emprestimo->livros as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach  </td>
             <td> {{ $emprestimo->data_de_devolucao }} </td>
             <td> {{ App\Models\EmprestimosEDevoluco::SITUACAO_SELECT[$emprestimo->situacao] ?? 'A devolver' }} </td>
             <td> </td>
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
  let table = $('.datatable-emprestimos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
