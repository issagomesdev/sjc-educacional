@extends('layouts.admin')
<title> Relatórios do Almoxarifado </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Produtos
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-produtos">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Produto </th>
           <th style="width: 50%;" aria-sort="none"> Unidades </th>
           <th style="width: 50%;" aria-sort="none"> Categorias </th>
           <th style="width: 50%;" aria-sort="none"> Situação </th>
           <th style="width: 50%;" aria-sort="none"> Consumível	</th>
           <th style="width: 50%;" aria-sort="none"> Quantidade Atual </th>
           <th style="width: 50%;" aria-sort="none"> Min </th>
           <th style="width: 50%;" aria-sort="none"> Max </th>
           <th style="width: 50%;" aria-sort="none"> Local </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($categorias_de_produtos as $key => $item)
                     <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                 @endforeach
             </select>
           </td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\Produto::SITUACAO_SELECT as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\Produto::CONSUMIVEL_SELECT as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
           <td> </td>
         </tr>
       <tbody>
         @foreach($produtos as $produto)
         <td> </td>
         <td></td>
             <td>
                {{ $produto->titulo }}
             </td>
             <td>
                {{ $produto->unidade }}
             </td>
             <td>
               @foreach($produto->categorias as $key => $categorias)
                   <span class="label label-info">{{ $categorias->titulo }}</span>
               @endforeach
             </td>
             <td>
                {{ App\Models\Produto::SITUACAO_SELECT[$produto->situacao] ?? 'Ativo' }}
             </td>
             <td>
               {{ App\Models\Produto::CONSUMIVEL_SELECT[$produto->consumivel] ?? 'Não' }}
             </td>
             <td>
               <?php

                $soma_quant = []; foreach($produtos_no_estoque as $key=>$value){ if (isset($soma_quant[$value["produto_id"]]))
                $soma_quant[$value["produto_id"]] += $value["quantidade"];
                else $soma_quant[$value["produto_id"]] = $value["quantidade"]; }

                $produtos_no_estoque = []; foreach($soma_quant as $key=>$value){
                $produtos_no_estoque[] = [ "produto_id" => $key, "quantidade" => $value ]; }

                foreach ($produtos_no_estoque as $produto_no_estoque) {
                if ($produto_no_estoque['produto_id'] == $produto->id) { echo $produto_no_estoque['quantidade']; }}

                ?>
                @if(!in_array($produto->id, $produtos_array)) 0 @endif
             </td>
             <td>
               {{ $produto->estoque_minimo }}
             </td>
             <td>
               {{ $produto->estoque_maximo }}
             </td>
             <td>
               {{ $produto->localizacao ?? 'Não atribuido' }}
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
  let table = $('.datatable-produtos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
