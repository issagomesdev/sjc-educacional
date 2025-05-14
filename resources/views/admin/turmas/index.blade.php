@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">
    @can('turma_access')
      <a href="{{ route("admin.turmas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/turmas") || request()->is("admin/turmas/*") ? "c-active" : "" }}">
        <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon"> </i> Turmas </a> @endcan

    @can('vaga_access')
        <a href="{{ route("admin.vagas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/vagas") || request()->is("admin/vagas/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-stamp c-sidebar-nav-icon"> </i> Vagas </a> @endcan

    @can('dispensa_access')
        <a href="{{ route("admin.dispensas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/dispensas") || request()->is("admin/dispensas/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-ban c-sidebar-nav-icon"> </i> Dispensas </a> @endcan

          @can('semaula_access')
              <a href="{{ route("admin.semaulas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/semaulas") || request()->is("admin/semaulas/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-user-times c-sidebar-nav-icon"> </i> Suspender Aulas </a> @endcan

    </div>
    </div>

@can('turma_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.turmas.create') }}">
                Cadastrar Turma
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Registros de Turmas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Turma">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.turma.fields.nivel_da_turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.tipo_de_turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.ano_serie') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.turno') }}
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
                        <td> <p class="fil">Nivel da Turma</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Turma::NIVEL_DA_TURMA_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Tipo de Turma</p>
                            <select class="search">
                                <option value="">{{ trans('global.all') }}</option>
                                <option value="Regular">Regular</option>
                                <option value="Diversificada">Diversificada</option>
                            </select>
                        </td>
                        <td> <p class="fil">Serie</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Creche I"> Creche I</option>
                                <option value="Creche II"> Creche II</option>
                                <option value="Pré-escolar"> Pré-escolar</option>
                                <option value="1º ano"> 1º ano </option>
                                <option value="2º ano"> 2º ano</option>
                                <option value="3º ano"> 3º ano</option>
                                <option value="4º ano"> 4º ano</option>
                                <option value="5º ano"> 5º ano</option>
                                <option value="6º ano"> 6º ano</option>
                                <option value="7º ano"> 7º ano</option>
                                <option value="8º ano"> 8º ano</option>
                                <option value="9º ano"> 9º ano</option>
                                <option value="1º ano(EJA)"> 1º ano - EJA </option>
                                <option value="2º ano(EJA)"> 2º ano - EJA </option>
                                <option value="3º ano(EJA)"> 3º ano - EJA </option>
                            </select>
                        </td>
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Turno</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Turma::TURNO_RADIO as $key => $item)
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
                    @foreach($turmas as $key => $turma)
                        <tr data-entry-id="{{ $turma->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Nivel da Turma:</strong> {{ App\Models\Turma::NIVEL_DA_TURMA_RADIO[$turma->nivel_da_turma] ?? '' }} </p>
                              <p> <strong>Tipo de Turma:</strong> {{ $turma->tipo_de_turma ?? '' }} </p>
                              <p> <strong>Turma:</strong> {{ $turma->serie ?? '' }} {{ $turma->identificacao ?? '' }} </p>
                              <p> <strong>Escola:</strong> {{ $turma->escola->name ?? '' }} </p>
                              <p> <strong>Turno:</strong> {{ App\Models\Turma::TURNO_RADIO[$turma->turno] ?? '' }} </p>
                            <p class="cad">
                              cadastrado em {{ $turma->created_at ?? '' }} por {{ $turma->assinatura->name ?? '' }} de {{ $turma->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ App\Models\Turma::NIVEL_DA_TURMA_RADIO[$turma->nivel_da_turma] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->tipo_de_turma ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->serie ?? '' }} {{ $turma->identificacao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->escola->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Turma::TURNO_RADIO[$turma->turno] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $turma->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $turma->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $turma->id }}" class="dropdown-content">
                                   @can('turma_show') <a href="{{ route('admin.turmas.show', $turma->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('turma_edit') <a href="{{ route('admin.turmas.edit', $turma->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('turma_delete') <form id="delete-{{ $turma->id }}" action="{{ route('admin.turmas.destroy', $turma->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $turma->id }}').submit()">
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

                                function showDropdown{{ $turma->id }}() {
                                document.getElementById("myDropdown{{ $turma->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/turmas.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('turma_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.turmas.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Turma:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
