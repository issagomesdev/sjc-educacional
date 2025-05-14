@extends('layouts.admin')
@section('content')
@can('documento_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.documentos.create') }}">
                Registrar Documento
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Documentos
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Documento">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.documento.fields.nome') }}
                        </th>
                        <th>
                            Instituição
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
                        <td>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td class="d"> </td>
                        <td> <p class="fil"> Instituição </p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $key => $documento)
                        <tr data-entry-id="{{ $documento->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Titulo:</strong> {{ $documento->nome ?? '' }} </p>
                                <p> <strong>Instituição:</strong> {{ $documento->instituicao->name ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $documento->created_at ?? '' }} por {{ $documento->assinatura->name ?? '' }} de {{ $documento->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $documento->nome ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $documento->instituicao->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $documento->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $documento->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $documento->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                             <div class="header">
                             <div class="dropdown">
                               <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $documento->id }}()"> <li></li> <li></li> <li></li> </ul>
                               <div id="myDropdown{{ $documento->id }}" class="dropdown-content">
                               @can('documento_show') <a href="{{ route('admin.documentos.show', $documento->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                               @can('documento_edit') <a href="{{ route('admin.documentos.edit', $documento->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                               @can('documento_delete') <form id="delete-{{ $documento->id }}" action="{{ route('admin.documentos.destroy', $documento->id) }}" method="POST">  @method('DELETE') @csrf </form>
                               <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $documento->id }}').submit()">
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

                            function showDropdown{{ $documento->id }}() {
                            document.getElementById("myDropdown{{ $documento->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/documentos.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('documento_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.documentos.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Documento:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
