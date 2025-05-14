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

@can('semaula_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.semaulas.create') }}">
                Suspender Aulas
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Suspensão de Aulas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Semaula">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.semaula.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.semaula.fields.de') }}
                        </th>
                        <th>
                            {{ trans('cruds.semaula.fields.ate') }}
                        </th>
                        <th>
                            {{ trans('cruds.semaula.fields.motivo') }}
                        </th>
                        <th>
                            Escolas
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
                        <td> <p class="fil">Motivo</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Semaula::MOTIVO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
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
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($semaulas as $key => $semaula)
                        <tr data-entry-id="{{ $semaula->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Titulo:</strong> {{ $semaula->titulo ?? '' }} </p>
                              <p> <strong>De:</strong> {{ $semaula->de ?? '' }} </p>
                              <p> <strong>Ate:</strong> {{ $semaula->ate ?? '' }} </p>
                              <p> <strong>Motivo:</strong> {{ App\Models\Semaula::MOTIVO_SELECT[$semaula->motivo] ?? '' }} </p>
                              <p> <strong>Escolas: </strong> {{ $semaula->instituicao->name ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $semaula->created_at ?? '' }} por {{ $semaula->assinatura->name ?? '' }} de {{ $semaula->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $semaula->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->de ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->ate ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Semaula::MOTIVO_SELECT[$semaula->motivo] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->instituicao->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $semaula->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $semaula->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $semaula->id }}" class="dropdown-content">
                                   @can('semaula_show') <a href="{{ route('admin.semaulas.show', $semaula->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('semaula_edit') <a href="{{ route('admin.semaulas.edit', $semaula->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('semaula_delete') <form id="delete-{{ $semaula->id }}" action="{{ route('admin.semaulas.destroy', $semaula->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $semaula->id }}').submit()">
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

                                function showDropdown{{ $semaula->id }}() {
                                document.getElementById("myDropdown{{ $semaula->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/sem-aulas.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('semaula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.semaulas.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-Semaula:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
