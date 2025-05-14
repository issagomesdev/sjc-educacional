@extends('layouts.admin')
@section('content')
@can('requisitante_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.requisitantes.create') }}">
                Cadastrar Requisitante
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Registros de Requisitantes
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Requisitante">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.requisitante.fields.nome') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisitante.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisitante.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.requisitante.fields.situacao') }}
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
                        <td class="d"> </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Requisitante::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Requisitante::SITUACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
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
                    @foreach($requisitantes as $key => $requisitante)
                        <tr data-entry-id="{{ $requisitante->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Nome:</strong> {{ $requisitante->nome ?? '' }} </p>
                                <p> <strong>Estado:</strong> {{ App\Models\Requisitante::ESTADO_SELECT[$requisitante->estado] ?? '' }} </p>
                                <p> <strong>Cidade:</strong> {{ $requisitante->cidade ?? '' }} </p>
                                <p> <strong>Situação:</strong> {{ App\Models\Requisitante::SITUACAO_SELECT[$requisitante->situacao] ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $requisitante->created_at ?? '' }} por {{ $requisitante->assinatura->name ?? '' }} de {{ $requisitante->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $requisitante->nome ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Requisitante::ESTADO_SELECT[$requisitante->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $requisitante->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Requisitante::SITUACAO_SELECT[$requisitante->situacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $requisitante->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $requisitante->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $requisitante->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $requisitante->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $requisitante->id }}" class="dropdown-content">
                              @can('requisitante_show') <a href="{{ route('admin.requisitantes.show', $requisitante->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('requisitante_edit') <a href="{{ route('admin.requisitantes.edit', $requisitante->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('requisitante_delete') <form id="delete-{{ $requisitante->id }}" action="{{ route('admin.requisitantes.destroy', $requisitante->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $requisitante->id }}').submit()">
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

                            function showDropdown{{ $requisitante->id }}() {
                            document.getElementById("myDropdown{{ $requisitante->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/requisitantes.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('requisitante_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.requisitantes.massDestroy') }}",
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
  let table = $('.datatable-Requisitante:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
