@extends('layouts.admin')
<title> Relatórios de Livros da Biblioteca </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Livros da Biblioteca
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-livro">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Titulo </th>
           <th style="width: 50%;" aria-sort="none"> Autor </th>
           <th style="width: 50%;" aria-sort="none"> Idioma </th>
           <th style="width: 50%;" aria-sort="none"> Biblioteca </th>
           <th style="width: 50%;" aria-sort="none"> Ano </th>
           <th style="width: 50%;" aria-sort="none"> Editora </th>
           <th style="width: 50%;" aria-sort="none"> Gênero </th>
           <th style="width: 50%;" aria-sort="none"> Exemplares Existentes </th>
           <th style="width: 50%;" aria-sort="none"> Exemplares Disponiveis </th>
           <th style="width: 50%;" aria-sort="none"> ISBN </th>
           <th style="width: 50%;" aria-sort="none"> CDD </th>
           <th style="width: 50%;" aria-sort="none"> Disponibilidade </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>

           <td>
             <select class="search">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach($bibliotecas as $biblioteca)
                     <option value="{{ $biblioteca->nome_da_biblioteca }}">{{ $biblioteca->nome_da_biblioteca }}</option>
                 @endforeach
             </select>
          </td>

           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>

           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\CadastrarLivro::GENERO_SELECT as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>

           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\CadastrarLivro::SELECIONE_RADIO as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
          </td>
           <td> </td>
         </tr>
       <tbody>

         <?php use App\Models\EmprestimosEDevoluco; ?>

         @foreach($livros as $livro)

         <?php

         $table = DB::table('cadastrar_livro_emprestimos_e_devoluco')
         ->where('cadastrar_livro_id', $livro->id)->pluck('emprestimos_e_devoluco_id');
         $emprestimosEDevolucos = EmprestimosEDevoluco::whereIn('id', $table)
         ->where('situacao', 'A devolver')
         ->orWhere('situacao', 'Prorrogado')
         ->orWhere('situacao', 'Atrasado')
         ->count();
         $exemplaresDisponiveis = $livro->exemplares_existentes - $emprestimosEDevolucos;

          ?>

         <td> </td>
         <td></td>
             <td> {{ $livro->titulo ?? 'Não atribuído' }} </td>
             <td> {{ $livro->autor ?? 'Não atribuído' }} </td>
             <td> {{ $livro->idioma ?? 'Não atribuído' }} </td>
             <td> {{ $livro->biblioteca->nome_da_biblioteca ?? 'Não atribuído' }} </td>
             <td> {{ $livro->ano ?? 'Não atribuído' }} </td>
             <td> {{ $livro->editora ?? 'Não atribuído' }} </td>
             <td> {{ App\Models\CadastrarLivro::GENERO_SELECT[$livro->genero] ?? 'Não atribuído' }} </td>
             <td> {{ $livro->exemplares_existentes ?? 'Não atribuído' }} </td>
             <td> {{ $exemplaresDisponiveis ?? 'Não atribuído' }} </td>
             <td> {{ $livro->isbn ?? 'Não atribuído' }} </td>
             <td> {{ $livro->cdd ?? 'Não atribuído' }} </td>
             <td> {{ App\Models\CadastrarLivro::SELECIONE_RADIO[$livro->selecione] ?? 'Não atribuído' }} </td>
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
  let table = $('.datatable-livro:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
