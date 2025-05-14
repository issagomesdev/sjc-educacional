@extends('layouts.admin')
@section('content')
@can('cadastrar_motoristum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrar-motorista.create') }}">
                Cadastrar Motorista
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Motoristas Cadastrados
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-CadastrarMotoristum">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.nome_completo') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.ano_de_contratacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.situacao_de_contratacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.instituicao') }}
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
                        <td> <p class="fil">Localização</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarMotoristum::LOCALIZACAO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarMotoristum::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarMotoristum::SITUACAO_DE_CONTRATACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Instituição</p>
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
                    @foreach($cadastrarMotorista as $key => $cadastrarMotoristum)
                        <tr data-entry-id="{{ $cadastrarMotoristum->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Nome:</strong> {{ $cadastrarMotoristum->nome_completo ?? '' }} </p>
                                <p> <strong>Localização:</strong> {{ App\Models\CadastrarMotoristum::LOCALIZACAO_RADIO[$cadastrarMotoristum->localizacao] ?? '' }} </p>
                                <p> <strong>Estado:</strong> {{ App\Models\CadastrarMotoristum::ESTADO_SELECT[$cadastrarMotoristum->estado] ?? '' }} </p>
                                <p> <strong>Cidade:</strong> {{ $cadastrarMotoristum->cidade ?? '' }} </p>
                                <p> <strong>Ano de Contratação:</strong> {{ $cadastrarMotoristum->ano_de_contratacao ?? '' }} </p>
                                <p> <strong>Situação de Contratação:</strong> {{ App\Models\CadastrarMotoristum::SITUACAO_DE_CONTRATACAO_SELECT[$cadastrarMotoristum->situacao_de_contratacao] ?? '' }} </p>
                                <p> <strong>Instituição:</strong> {{ $cadastrarMotoristum->instituicao->name ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $cadastrarMotoristum->created_at ?? '' }} por {{ $cadastrarMotoristum->assinatura->name ?? '' }} de {{ $cadastrarMotoristum->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->nome_completo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarMotoristum::LOCALIZACAO_RADIO[$cadastrarMotoristum->localizacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarMotoristum::ESTADO_SELECT[$cadastrarMotoristum->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->ano_de_contratacao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarMotoristum::SITUACAO_DE_CONTRATACAO_SELECT[$cadastrarMotoristum->situacao_de_contratacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->instituicao->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarMotoristum->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $cadastrarMotoristum->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $cadastrarMotoristum->id }}" class="dropdown-content">
                                   @can('cadastrar_motoristum_show') <a href="{{ route('admin.cadastrar-motorista.show', $cadastrarMotoristum->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('cadastrar_motoristum_edit') <a href="{{ route('admin.cadastrar-motorista.edit', $cadastrarMotoristum->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('cadastrar_motoristum_delete') <form id="delete-{{ $cadastrarMotoristum->id }}" action="{{ route('admin.cadastrar-motorista.destroy', $cadastrarMotoristum->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $cadastrarMotoristum->id }}').submit()">
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

                                function showDropdown{{ $cadastrarMotoristum->id }}() {
                                document.getElementById("myDropdown{{ $cadastrarMotoristum->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/cadastrar-motorista.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cadastrar_motoristum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrar-motorista.massDestroy') }}",
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
  let table = $('.datatable-CadastrarMotoristum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
