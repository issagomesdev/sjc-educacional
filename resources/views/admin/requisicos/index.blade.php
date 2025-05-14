@extends('layouts.admin')
@section('content')
@can('requisico_create')

    <div class="contein">
      <form method="GET" action="{{ route('admin.requisicos.create') }}">

    <div class="form-group">
      <select class="form-control selectd" name="estoque" id="estoque" required>
          <option value=""> Selecione Estoque </option>
          @foreach($estoques as $estoque)
              <option value="{{ $estoque->id }}">{{ $estoque->titulo }}</option>
          @endforeach
      </select>
    </div>

        <div style="margin-bottom: 10px;" class="row"> <div class="col-lg-12">
        <input class="btn btn-success" type="submit" value="Cadastrar Requisição"> </div>
      </div>
      </form>
      </div>

@endcan
<div class="card">
    <div class="card-header">
        Registros de Requisições
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Requisico">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.requisico.fields.estoque') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisico.fields.requisitantes') }}
                        </th>
                        <th>
                            Situação
                        </th>
                        <th>
                            Por:
                        </th>
                        <th>
                            De:
                        </th>
                        <th>
                            Data
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                      <td> </td>
                      <td> </td>
                         <td> <p class="fil"> Estoque </p>
                             <select class="search">
                                 <option value>{{ trans('global.all') }}</option>
                                 @foreach($estoques as $key => $item)
                                     <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                                 @endforeach
                             </select>
                         </td>
                         <td> <p class="fil"> Requisitante </p>
                             <select class="search">
                                 <option value>{{ trans('global.all') }}</option>
                                 @foreach($requisitantes as $key => $item)
                                     <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                 @endforeach
                             </select>
                         </td>
                         <td> <p class="fil"> Situação </p>
                             <select class="search">
                                 <option value>{{ trans('global.all') }}</option>
                                 <option value="Pendente"> Pendente </option>
                                 <option value="Aprovado"> Aprovado </option>
                                 <option value="Entregue"> Entregue </option>
                                 <option value="Reprovado"> Reprovado </option>
                                 <option value="Cancelado"> Cancelado </option>
                             </select>
                         </td>
                         <td class="d"> </td>
                         <td class="d"> </td>
                         <td class="d"> </td>
                         <td> </td>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($requisicos as $key => $requisico)
                         <tr data-entry-id="{{ $requisico->id }}">
                           <td> </td>
                           <td>
                               <p> <strong>Estoque:</strong> {{ $requisico->estoque->titulo ?? '' }} </p>
                               <p> <strong>Requisitante:</strong> {{ $requisico->requisitantes->nome ?? '' }} </p>
                               <p> <strong>Situação:</strong> {{ $requisico->situacao ?? 'Pendente' }} </p>
                               <p class="cad">
                               cadastrado em {{ $requisico->created_at ?? '' }} por {{ $requisico->assinatura->name ?? '' }} de {{ $requisico->team->name ?? '' }}
                               </p>
                           </td>
                             <td class="invisib">
                                 {{ $requisico->estoque->titulo ?? '' }}
                             </td>
                             <td class="invisib">
                                 {{ $requisico->requisitantes->nome ?? '' }}
                             </td>
                             <td class="invisib">
                                 {{ $requisico->situacao ?? 'Pendente' }}
                             </td>
                             <td class="invisib">
                                 {{ $requisico->assinatura->name ?? '' }}
                             </td>
                             <td class="invisib">
                                 {{ $requisico->team->name ?? '' }}
                             </td>
                             <td class="invisib">
                                 {{ $requisico->created_at ?? '' }}
                             </td>
                             <td class="btnn">
                             <div class="header">
                             <div class="dropdown">
                               <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $requisico->id }}()"> <li></li> <li></li> <li></li> </ul>
                               <div id="myDropdown{{ $requisico->id }}" class="dropdown-content">
                               @can('requisico_up') <a href="{{ route('admin.requisicos.situacao') }}?id={{$requisico->id}}"> <i class="fas fa-clipboard-check"></i> Atualizar Situação </a> @endcan
                               @can('requisico_show') <a href="{{ route('admin.requisicos.show', $requisico->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                               @can('requisico_edit') <a href="{{ route('admin.requisicos.edit', $requisico->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                               @can('requisico_delete') <form id="delete-{{ $requisico->id }}" action="{{ route('admin.requisicos.destroy', $requisico->id) }}" method="POST">  @method('DELETE') @csrf </form>
                               <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $requisico->id }}').submit()">
                               <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                               </div>
                             </div>
                             </div>
                             </td>
                             </tr>
                             @section('scripts')
                             @parent
                             <script>

                             function changeLanguage(language) {
                             var element = document.getElementById("url");
                             element.value = language;
                             element.innerHTML = language;
                             }

                             function showDropdown{{ $requisico->id }}() {
                             document.getElementById("myDropdown{{ $requisico->id }}").classList.toggle("dshow");
                             }

                             // Close the dropdown if the user clicks outside of it
                             window.onclick = function(event) {
                             if (!event.target.matches(".dropbtn")) {
                             var dropdowns = document.getElementsByClassName("dropdown-content");
                             var i;
                             for (i = 0; i < dropdowns.length; i++) {
                             var openDropdown = dropdowns[i];
                             if (openDropdown.classList.contains("dshow")) {
                               openDropdown.classList.remove("dshow");
                             }
                             }
                             }
                             };

                             </script>
                             @endsection
                             @endforeach
                             </tbody>
                             </table>
                             </div>
                             </div>
                             </div>

 <link rel="stylesheet" href="{{ url('css/panel.css') }}">
 <link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
 <link rel="stylesheet" href="{{ url('resources/requisicoes.css') }}">

 @endsection
 @section('scripts')
 @parent
 <script>
     $(function () {
   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 @can('requisico_delete')
   let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
   let deleteButton = {
     text: deleteButtonTrans,
     url: "{{ route('admin.requisicos.massDestroy') }}",
     className: 'btn-danger',
     action: function (e, dt, node, config) {
       var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
           return $(entry).data('entry-id')
       });

       if (ids.length === 0) {
         alert('{{ trans('global.datatables.zero_selected') }}')

         return
       }

       if (confirm('{{ trans('global.areYouSure') }}')) {
         $.ajax({
           headers: {'x-csrf-token': _token},
           method: 'POST',
           url: config.url,
           data: { ids: ids, _method: 'DELETE' }})
           .done(function () { location.reload() })
       }
     }
   }
   dtButtons.push(deleteButton)
 @endcan

   $.extend(true, $.fn.dataTable.defaults, {
     orderCellsTop: true,
     order: [[ 7, 'desc' ]],
     pageLength: 100,
   });
   let table = $('.datatable-Requisico:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
