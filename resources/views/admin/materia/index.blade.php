@extends('layouts.admin')
@section('content')
@can('materium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.materia.create') }}">
                Adicionar Disciplina
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Disciplinas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-Materium">
                <thead>
                    <tr>
                      <th class="noExport" width="10"></th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.materium.fields.nome_da_materia') }}
                        </th>
                        <th>
                            Nivel de Ensino
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
                        <td> <p class="fil">Nivel de Ensino</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Materium::INDIQUE_O_NIVEL_DE_ENSINO_RADIO as $key => $item)
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
                    @foreach($materia as $key => $materium)
                        <tr data-entry-id="{{ $materium->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Nome:</strong> {{ $materium->nome_da_materia ?? 'Não atribuido' }} </p>
                                <p> <strong>Nivel de ensino:</strong> {{ $materium->nivel_de_ensino ?? 'Não atribuido' }} </p>
                                <p class="cad">
                                cadastrado em {{ $materium->created_at ?? '' }} por {{ $materium->assinatura->name ?? '' }} de {{ $materium->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $materium->nome_da_materia ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $materium->nivel_de_ensino ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $materium->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $materium->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $materium->created_at ?? '' }}
                            </td>
                    <td class="btnn">
                     <div class="header">
                     <div class="dropdown">
                       <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $materium->id }}()"> <li></li> <li></li> <li></li> </ul>
                       <div id="myDropdown{{ $materium->id }}" class="dropdown-content">
                       @can('materium_show') <a href="{{ route('admin.materia.show', $materium->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                       @can('materium_edit') <a href="{{ route('admin.materia.edit', $materium->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                       @can('materium_delete') <form id="delete-{{ $materium->id }}" action="{{ route('admin.materia.destroy', $materium->id) }}" method="POST">  @method('DELETE') @csrf </form>
                       <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $materium->id }}').submit()">
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

                    function showDropdown{{ $materium->id }}() {
                    document.getElementById("myDropdown{{ $materium->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/disciplina.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('materium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.materia.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Materium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
