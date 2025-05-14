@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">
      @can('profissional_access')
              <a href="{{ route("admin.profissionais.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/profissionais") || request()->is("admin/profissionais/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">  </i>
                  Profissionais
              </a>
      @endcan

      @can('tipo_de_profissional_access')
                            <a href="{{ route("admin.tipo-de-profissionals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipo-de-profissionals") || request()->is("admin/tipo-de-profissionals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-tag c-sidebar-nav-icon"> </i>
                                {{ trans('cruds.tipoDeProfissional.title') }}
                            </a>
      @endcan
      @can('instalar_access')
              <a href="{{ route("admin.instalars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/instalars") || request()->is("admin/instalars/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon"> </i>
                  Instalar Profissional
              </a>
      @endcan
      @can('deslocar_access')
              <a href="{{ route("admin.deslocars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/deslocars") || request()->is("admin/deslocars/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-minus c-sidebar-nav-icon">   </i>
                  Deslocar Profissional
              </a>
      @endcan
    </div>
    </div>

@can('deslocar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.deslocars.instituicao') }}">
                Deslocar Profissional
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Deslocamento de Profissionais
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Deslocar">
                <thead>
                    <tr>
                      <th class="noExport" width="10"></th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.deslocar.fields.ano') }}
                        </th>
                        <th>
                            Instituição
                        </th>
                        <th>
                            Instituição de destino
                        </th>
                        <th>
                            {{ trans('cruds.deslocar.fields.profissional') }}
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
                        <td> <p class="fil">Instituição</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Instituição destino</p>
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
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deslocars as $key => $deslocar)
                        <tr data-entry-id="{{ $deslocar->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Ano:</strong> {{ $deslocar->ano ?? 'Não atribuido' }} </p>
                              <p> <strong>Instituição:</strong> {{ $deslocar->institucao_1->name ?? '' }} </p>
                              <p> <strong>Profissional:</strong> {{ $deslocar->profissional->nome_completo ?? '' }} </p>
                              <p> <strong>Instituição de destino:</strong> {{ $deslocar->institucao_2->name ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $deslocar->created_at ?? '' }} por {{ $deslocar->assinatura->name ?? '' }} de {{ $deslocar->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $deslocar->ano ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->institucao_1->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->institucao_2->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->profissional->nome_completo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $deslocar->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $deslocar->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $deslocar->id }}" class="dropdown-content">
                                  @can('deslocar_show') <a href="{{ route('admin.deslocars.show', $deslocar->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
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

                                function showDropdown{{ $deslocar->id }}() {
                                document.getElementById("myDropdown{{ $deslocar->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/deslocars.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('deslocar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.deslocars.massDestroy') }}",
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
  let table = $('.datatable-Deslocar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
