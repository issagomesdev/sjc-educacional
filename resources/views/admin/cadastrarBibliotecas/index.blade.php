@extends('layouts.admin')
@section('content')
@can('cadastrar_biblioteca_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrar-bibliotecas.create') }}">
                Cadastrar Biblioteca
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Bibliotecas Cadastradas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-CadastrarBiblioteca">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.nome_da_biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.cidade') }}
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
                        <td> <p class="fil">Local</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarBiblioteca::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarBibliotecas as $key => $cadastrarBiblioteca)
                        <tr data-entry-id="{{ $cadastrarBiblioteca->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Nome:</strong> {{ $cadastrarBiblioteca->nome_da_biblioteca ?? '' }} </p>
                                <p> <strong>Localização:</strong> {{ App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO[$cadastrarBiblioteca->localizacao] ?? '' }} </p>
                                <p> <strong>Estado:</strong> {{ App\Models\CadastrarBiblioteca::ESTADO_SELECT[$cadastrarBiblioteca->estado] ?? '' }} </p>
                                <p> <strong>Cidade:</strong> {{ $cadastrarBiblioteca->cidade ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $cadastrarBiblioteca->created_at ?? '' }} por {{ $cadastrarBiblioteca->assinatura->name ?? '' }} de {{ $cadastrarBiblioteca->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $cadastrarBiblioteca->nome_da_biblioteca ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO[$cadastrarBiblioteca->localizacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarBiblioteca::ESTADO_SELECT[$cadastrarBiblioteca->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarBiblioteca->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarBiblioteca->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarBiblioteca->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarBiblioteca->created_at ?? '' }}
                            </td>
                    <td class="btnn">
                    <div class="header">
                    <div class="dropdown">
                      <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $cadastrarBiblioteca->id }}()"> <li></li> <li></li> <li></li> </ul>
                      <div id="myDropdown{{ $cadastrarBiblioteca->id }}" class="dropdown-content">
                      @can('cadastrar_biblioteca_show') <a href="{{ route('admin.cadastrar-bibliotecas.show', $cadastrarBiblioteca->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                      @can('cadastrar_biblioteca_edit') <a href="{{ route('admin.cadastrar-bibliotecas.edit', $cadastrarBiblioteca->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                      @can('cadastrar_biblioteca_delete') <form id="delete-{{ $cadastrarBiblioteca->id }}" action="{{ route('admin.cadastrar-bibliotecas.destroy', $cadastrarBiblioteca->id) }}" method="POST">  @method('DELETE') @csrf </form>
                      <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $cadastrarBiblioteca->id }}').submit()">
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

              function showDropdown{{ $cadastrarBiblioteca->id }}() {
                document.getElementById("myDropdown{{ $cadastrarBiblioteca->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/cadastrar-bibliotecas.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cadastrar_biblioteca_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrar-bibliotecas.massDestroy') }}",
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
  let table = $('.datatable-CadastrarBiblioteca:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
