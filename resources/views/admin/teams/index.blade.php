@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">

    @can('team_access')
      <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
        <i class="fa-fw fas fa-university c-sidebar-nav-icon"> </i> Instituição </a> @endcan

    @can('team_type_access')
      <a href="{{ route("admin.team-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/team-types") || request()->is("admin/team-types/*") ? "c-active" : "" }}">
        <i class="fa-fw fas fa-tags c-sidebar-nav-icon"> </i> Tipos de Instituição </a> @endcan

    </div>
    </div>

@can('team_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.teams.create') }}">
                Cadastrar Instituição
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Instituições
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Team">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.team.fields.name') }}
                        </th>
                        <th>
                            Tipo de Instituição
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.owner') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.cidade') }}
                        </th>
                        <th>
                            Situação
                        </th>
                        <th>
                            Dependência Administrativa
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
                      <td> <p class="fil">Tipo de Instituição</p>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($team_types as $key => $item)
                                <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                            @endforeach
                        </select>
                      </td>
                      <td class="d"> </td>
                      <td class="d"> </td>
                        <td> <p class="fil">localização</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Team::LOCALIZACAO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Team::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Team::SITUACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Administração</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT as $key => $item)
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
                    @foreach($teams as $key => $team)
                        <tr data-entry-id="{{ $team->id }}">
                          <td></td>
                          <td>
                              <p> <strong>Nome:</strong> {{ $team->name ?? '' }} </p>
                              <p> <strong>Responsavel:</strong> {{ $team->owner->name ?? '' }} </p>
                              <p> <strong>localização:</strong> {{ App\Models\Team::LOCALIZACAO_RADIO[$team->localizacao] ?? '' }} </p>
                              <p> <strong>Estado:</strong> {{ App\Models\Team::ESTADO_SELECT[$team->estado] ?? '' }} </p>
                              <p> <strong>Cidade:</strong> {{ $team->cidade ?? '' }} </p>
                              <p> <strong>Tipo de Instituição:</strong> {{ $team->tipo_de_instituicao->titulo ?? '' }} </p>
                              <p> <strong>Situação:</strong> {{ App\Models\Team::SITUACAO_SELECT[$team->situacao] ?? '' }} </p>
                              <p> <strong>Dependência Administrativa:</strong> {{ App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT[$team->dependencia_administrativa] ?? '' }} </p>
                            <p class="cad">
                              cadastrado em {{ $team->created_at ?? '' }} por {{ $team->assinatura->name ?? '' }} de {{ $team->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->tipo_de_instituicao->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->owner->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Team::LOCALIZACAO_RADIO[$team->localizacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Team::ESTADO_SELECT[$team->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Team::SITUACAO_SELECT[$team->situacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT[$team->dependencia_administrativa] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $team->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $team->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $team->id }}" class="dropdown-content">
                                   @can('semaula_show') <a href="{{ route('admin.teams.show', $team->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('semaula_edit') <a href="{{ route('admin.teams.edit', $team->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('semaula_delete') <form id="delete-{{ $team->id }}" action="{{ route('admin.teams.destroy', $team->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $team->id }}').submit()">
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

                                function showDropdown{{ $team->id }}() {
                                document.getElementById("myDropdown{{ $team->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/teams.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('team_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teams.massDestroy') }}",
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
  let table = $('.datatable-Team:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
