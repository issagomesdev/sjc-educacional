@extends('layouts.admin')
@section('content')
@can('rotum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.rota.create') }}">
                Cadastrar Rota
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Rotas Cadastradas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-Rotum">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.rotum.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_saida') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.origem') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_destino') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.destino') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.quilometros_percorridos') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.veiculo_responsavel') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.motorista_responsavel') }}
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
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rota as $key => $rotum)
                        <tr data-entry-id="{{ $rotum->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Ano:</strong> {{ $rotum->ano ?? '' }} </p>
                                <p> <strong>Saida as:</strong> {{ $rotum->horario_de_saida ?? '' }} </p>
                                <p> <strong>Origem:</strong> {{ $rotum->origem ?? '' }} </p>
                                <p> <strong>Chegada as:</strong> {{ $rotum->horario_de_destino ?? '' }} </p>
                                <p> <strong>Destino:</strong> {{ $rotum->destino ?? '' }} </p>
                                <p> <strong>Quilômetros Percorridos:</strong> {{ $rotum->quilometros_percorridos ?? '' }} </p>
                                <p> <strong>Veiculo Responsável:</strong> Marca: {{ $rotum->veiculo_responsavel->marca ?? '' }}, Placa: {{ $rotum->veiculo_responsavel->placa ?? '' }}, {{ $rotum->veiculo_responsavel->descricao ?? '' }}  </p>
                                <p> <strong>Motorista Responsável:</strong> {{ $rotum->motorista_responsavel->nome_completo ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $rotum->created_at ?? '' }} por {{ $rotum->assinatura->name ?? '' }} de {{ $rotum->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $rotum->ano ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->horario_de_saida ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->origem ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->horario_de_destino ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->destino ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->quilometros_percorridos ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->veiculo_responsavel->descricao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->motorista_responsavel->nome_completo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rotum->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                             <div class="header">
                             <div class="dropdown">
                               <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $rotum->id }}()"> <li></li> <li></li> <li></li> </ul>
                               <div id="myDropdown{{ $rotum->id }}" class="dropdown-content">
                               @can('rotum_show') <a href="{{ route('admin.rota.show', $rotum->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                               @can('rotum_edit') <a href="{{ route('admin.rota.edit', $rotum->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                               @can('rotum_delete') <form id="delete-{{ $rotum->id }}" action="{{ route('admin.rota.destroy', $rotum->id) }}" method="POST">  @method('DELETE') @csrf </form>
                               <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $rotum->id }}').submit()">
                               <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                               </div>
                             </div>
                           </div>
                           </td>
                         </tr>
                     </div>
              @section('scripts')
              @parent
              <script>

              function changeLanguage(language) {
                var element = document.getElementById("url");
                element.value = language;
                element.innerHTML = language;
              }

              function showDropdown{{ $rotum->id }}() {
                document.getElementById("myDropdown{{ $rotum->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/rota.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('rotum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rota.massDestroy') }}",
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
  let table = $('.datatable-Rotum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
