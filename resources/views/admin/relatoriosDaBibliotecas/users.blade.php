@extends('layouts.admin')
<title> Relatórios de Usuários da Biblioteca </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Usuários da Biblioteca
    </div>
 </div>

 <div class="grapic">
   <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-users">
     <thead>
         <tr>
           <th class="noExport"> </th>
           <th class="noSorting"> </th>
           <th style="width: 50%;" aria-sort="none"> Nome </th>
           <th style="width: 50%;" aria-sort="none"> Data De Nascimento	 </th>
           <th style="width: 50%;" aria-sort="none"> Gênero </th>
           <th style="width: 50%;" aria-sort="none"> Nacionalidade </th>
           <th style="width: 50%;" aria-sort="none"> Localização </th>
           <th style="width: 50%;" aria-sort="none"> Estado </th>
           <th style="width: 50%;" aria-sort="none"> Cidade </th>
           <th style="width: 50%;" aria-sort="none"> Bairro </th>
           <th style="width: 50%;" aria-sort="none"> Endereço </th>
           <th style="width: 50%;" aria-sort="none"> E-Mail De Contato </th>
           <th style="width: 50%;" aria-sort="none"> Numero Do CPF </th>
           <th style="width: 50%;" aria-sort="none"> Numero Da Identidade </th>
           <th style="width: 50%;" aria-sort="none"> Numero De Telefone </th>
           <th> </th>
         </tr>
         <tr>
           <td class="select"> </td>
           <td> </td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\UsuariosDaBiblioteca::GENERO_RADIO as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\UsuariosDaBiblioteca::LOCALIZACAO_RADIO as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>
           <td>
             <select class="search" strict="true">
                 <option value>{{ trans('global.all') }}</option>
                 @foreach(App\Models\UsuariosDaBiblioteca::ESTADO_SELECT as $key => $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                 @endforeach
             </select>
           </td>

           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
           <td> </td>
         </tr>
       <tbody>
       @foreach($users as $user)
         <td> </td>
         <td></td>
             <td> {{ $user->nome_completo ?? 'Não atribuído' }} </td>
             <td> {{ $user->data_de_nascimento ?? 'Não atribuído' }} </td>
             <td> {{ App\Models\UsuariosDaBiblioteca::GENERO_RADIO[$user->genero] ?? '' }} </td>
             <td> {{ $user->nacionalidade }} </td>
             <td> {{ App\Models\UsuariosDaBiblioteca::LOCALIZACAO_RADIO[$user->localizacao] ?? '' }} </td>
             <td> {{ App\Models\UsuariosDaBiblioteca::ESTADO_SELECT[$user->estado] ?? '' }} </td>
             <td> {{ $user->cidade ?? 'Não atribuído' }} </td>
             <td> {{ $user->bairro ?? 'Não atribuído' }} </td>
             <td> {{ $user->endereco ?? 'Não atribuído' }} </td>
             <td> {{ $user->e_mail_de_contato ?? 'Não atribuído' }} </td>
             <td> {{ $user->numero_do_cpf }} </td>
             <td> {{ $user->numero_da_identidade ?? 'Não atribuído' }} </td>
             <td> {{ $user->numero_de_telefone }} </td>
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
  let table = $('.datatable-users:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
