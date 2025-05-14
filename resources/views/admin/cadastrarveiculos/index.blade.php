@extends('layouts.admin')
@section('content')
@can('cadastrarveiculo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrarveiculos.create') }}">
                Cadastrar Veículo
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Veículos Cadastrados
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-Cadastrarveiculo">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.niv') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.placa') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.renavam') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.marca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.instituicao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.situacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.motorista_responsavel') }}
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
                        <td> <p class="fil">Instituição</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Cadastrarveiculo::SITUACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td>
                        </td>
                         </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarveiculos as $key => $cadastrarveiculo)
                    <tr data-entry-id="{{ $cadastrarveiculo->id }}">
                        <td> </td>
                        <td>
                            <p> <strong>Niv:</strong> {{ $cadastrarveiculo->niv ?? '' }} </p>
                            <p> <strong>Placa:</strong> {{ $cadastrarveiculo->placa ?? '' }} </p>
                            <p> <strong>Renavam:</strong> {{ $cadastrarveiculo->renavam ?? '' }} </p>
                            <p> <strong>Marca:</strong> {{ $cadastrarveiculo->marca ?? '' }} </p>
                            <p> <strong>Instituição:</strong> {{ $cadastrarveiculo->instituicao->name ?? '' }} </p>
                            <p> <strong>Motorista:</strong> @foreach($cadastrarveiculo->motorista_responsavels as $key => $item) <span class="badge badge-info">{{ $item->nome_completo }}</span> @endforeach </p>
                            <p> <strong>Situação:</strong> {{ App\Models\Cadastrarveiculo::SITUACAO_SELECT[$cadastrarveiculo->situacao] ?? '' }} </p>
                            <p class="cad">
                            cadastrado em {{ $cadastrarveiculo->created_at ?? '' }} por {{ $cadastrarveiculo->assinatura->name ?? '' }} de {{ $cadastrarveiculo->team->name ?? '' }}
                            </p>
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->niv ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->placa ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->renavam ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->marca ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->instituicao->name ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ App\Models\Cadastrarveiculo::SITUACAO_SELECT[$cadastrarveiculo->situacao] ?? '' }}
                        </td>
                        <td class="invisib">
                            @foreach($cadastrarveiculo->motorista_responsavels as $key => $item)
                                <span class="badge badge-info">{{ $item->nome_completo }}</span>
                            @endforeach
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->assinatura->name ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->team->name ?? '' }}
                        </td>
                        <td class="invisib">
                            {{ $cadastrarveiculo->created_at ?? '' }}
                        </td>
                    <td class="btnn">
                     <div class="header">
                     <div class="dropdown">
                       <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $cadastrarveiculo->id }}()"> <li></li> <li></li> <li></li> </ul>
                       <div id="myDropdown{{ $cadastrarveiculo->id }}" class="dropdown-content">
                      @can('cadastrarveiculo_show') <a href="{{ route('admin.cadastrarveiculos.show', $cadastrarveiculo->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                      @can('cadastrarveiculo_edit') <a href="{{ route('admin.cadastrarveiculos.edit', $cadastrarveiculo->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                      @can('cadastrarveiculo_delete') <form id="delete-{{ $cadastrarveiculo->id }}" action="{{ route('admin.cadastrarveiculos.destroy', $cadastrarveiculo->id) }}" method="POST">  @method('DELETE') @csrf </form>
                       <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $cadastrarveiculo->id }}').submit()">
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

                    function showDropdown{{ $cadastrarveiculo->id }}() {
                    document.getElementById("myDropdown{{ $cadastrarveiculo->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/cadastrar-veiculos.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cadastrarveiculo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrarveiculos.massDestroy') }}",
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
    order: [[ 4, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Cadastrarveiculo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
