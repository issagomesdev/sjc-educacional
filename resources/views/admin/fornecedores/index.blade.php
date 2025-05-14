@extends('layouts.admin')
@section('content')
@can('fornecedore_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fornecedores.create') }}">
                Cadastrar Fornecedor
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Fornecedores
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Fornecedore">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                          Nome
                        </th>
                        <th>
                          Estado
                        </th>
                        <th>
                            Cidade
                        </th>
                        <th>
                            Telefone
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
                        <td class="d"> </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Fornecedore::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Fornecedore::SITUACAO_SELECT as $key => $item)
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
                    @foreach($fornecedores as $key => $fornecedore)
                        <tr data-entry-id="{{ $fornecedore->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Nome:</strong> {{ $fornecedore->nome ?? '' }} </p>
                              <p> <strong>Estado:</strong> {{ App\Models\Fornecedore::ESTADO_SELECT[$fornecedore->estado] ?? '' }} </p>
                              <p> <strong>Cidade:</strong> {{ $fornecedore->cidade ?? '' }} </p>
                              <p> <strong>Telefone:</strong> {{ $fornecedore->telefone_1 ?? '' }} </p>
                              <p> <strong>Situação:</strong>  {{ App\Models\Fornecedore::SITUACAO_SELECT[$fornecedore->situacao] ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $fornecedore->created_at ?? '' }} por {{ $fornecedore->assinatura->name ?? '' }} de {{ $fornecedore->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $fornecedore->nome ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Fornecedore::ESTADO_SELECT[$fornecedore->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $fornecedore->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $fornecedore->telefone_1 ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Fornecedore::SITUACAO_SELECT[$fornecedore->situacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $fornecedore->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $fornecedore->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $fornecedore->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                <div class="header">
                                <div class="dropdown">
                                  <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $fornecedore->id }}()"> <li></li> <li></li> <li></li> </ul>
                                  <div id="myDropdown{{ $fornecedore->id }}" class="dropdown-content">
                                  @can('fornecedore_show') <a href="{{ route('admin.fornecedores.show', $fornecedore->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                  @can('fornecedore_edit') <a href="{{ route('admin.fornecedores.edit', $fornecedore->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                  @can('fornecedore_delete') <form id="delete-{{ $fornecedore->id }}" action="{{ route('admin.fornecedores.destroy', $fornecedore->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                  <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $fornecedore->id }}').submit()">
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

                                function showDropdown{{ $fornecedore->id }}() {
                                document.getElementById("myDropdown{{ $fornecedore->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/fornecedores.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fornecedore_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fornecedores.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-Fornecedore:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
