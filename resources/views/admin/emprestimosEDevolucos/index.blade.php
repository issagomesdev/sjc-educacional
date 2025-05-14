@extends('layouts.admin')
@section('content')
@can('emprestimos_e_devoluco_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.emprestimos-e-devolucos.create') }}">
                Cadastrar Empréstimo de Livro
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Empréstimos de Livro
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-EmprestimosEDevoluco">
                <thead>
                    <tr>
                       <th class="noExport" width="10"> </th>
                       <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.usuario_da_biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.livros') }}
                        </th>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.data_de_devolucao') }}
                        </th>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.situacao') }}
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
                        <td> </td>
                        <td> <p class="fil">Biblioteca</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($cadastrar_bibliotecas as $key => $item)
                                    <option value="{{ $item->nome_da_biblioteca }}">{{ $item->nome_da_biblioteca }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> </td>
                        <td class="d"> </td>
                        <td> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimosEDevolucos as $key => $emprestimosEDevoluco)
                        <tr data-entry-id="{{ $emprestimosEDevoluco->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Usuário:</strong> {{ $emprestimosEDevoluco->usuario_da_biblioteca->nome_completo ?? '' }} </p>
                              <p> <strong>Biblioteca:</strong> {{ $emprestimosEDevoluco->biblioteca->nome_da_biblioteca ?? '' }} </p>
                              <p> <strong>Livros:</strong> @foreach($emprestimosEDevoluco->livros as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach </p>
                              <p> <strong>Data da Devolução:</strong> {{ $emprestimosEDevoluco->data_de_devolucao ?? '' }} </p>
                              <p> <strong>Situação:</strong> {{ App\Models\EmprestimosEDevoluco::SITUACAO_SELECT[$emprestimosEDevoluco->situacao] ?? 'A devolver' }} </p>
                              <p class="cad">
                              cadastrado em {{ $emprestimosEDevoluco->created_at ?? '' }} por {{ $emprestimosEDevoluco->assinatura->name ?? '' }} de {{ $emprestimosEDevoluco->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->usuario_da_biblioteca->nome_completo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->biblioteca->nome_da_biblioteca ?? '' }}
                            </td>
                            <td class="invisib">
                                @foreach($emprestimosEDevoluco->livros as $key => $item)
                                    <span class="badge badge-info">{{ $item->titulo }}</span>
                                @endforeach
                            </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->data_de_devolucao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\EmprestimosEDevoluco::SITUACAO_SELECT[$emprestimosEDevoluco->situacao] ?? 'A devolver' }}
                            </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $emprestimosEDevoluco->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                  <div class="header">
                                  <div class="dropdown">
                                  <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $emprestimosEDevoluco->id }}()"> <li></li> <li></li> <li></li> </ul>
                                  <div id="myDropdown{{ $emprestimosEDevoluco->id }}" class="dropdown-content">
                                  @can('emprestimos_e_devoluco_up') <a href="{{ route('admin.emprestimos-e-devolucos.situacao') }}?id={{$emprestimosEDevoluco->id}}"> <i class="fas fa-clipboard-check"></i> Atualizar Situação </a> @endcan
                                  @can('emprestimos_e_devoluco_show') <a href="{{ route('admin.emprestimos-e-devolucos.show', $emprestimosEDevoluco->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                  @can('emprestimos_e_devoluco_edit') <a href="{{ route('admin.emprestimos-e-devolucos.edit', $emprestimosEDevoluco->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                  @can('emprestimos_e_devoluco_delete') <form id="delete-{{ $emprestimosEDevoluco->id }}" action="{{ route('admin.emprestimos-e-devolucos.destroy', $emprestimosEDevoluco->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                  <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $emprestimosEDevoluco->id }}').submit()">
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

                                  function showDropdown{{ $emprestimosEDevoluco->id }}() {
                                  document.getElementById("myDropdown{{ $emprestimosEDevoluco->id }}").classList.toggle("dshow");
                                  }


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
                                  <link rel="stylesheet" href="{{ url('resources/emprestimos-e-devolucoes.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('emprestimos_e_devoluco_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.emprestimos-e-devolucos.massDestroy') }}",
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
    order: [[ 9, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-EmprestimosEDevoluco:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
