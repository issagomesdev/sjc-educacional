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

@can('instalar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.instalars.create') }}">
                Instalar Profissional
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Instalação de Profissionais
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Instalar">
                <thead>
                    <tr>
                      <th class="noExport" width="10"></th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.instalar.fields.ano') }}
                        </th>
                        <th>
                            Função
                        </th>
                        <th>
                            {{ trans('cruds.instalar.fields.instituicao') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalar.fields.profissional') }}
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
                        <td> <p class="fil">Função</p>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              @foreach($tipo_de_profissionals as $key => $item)
                                  <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
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
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instalars as $key => $instalar)
                        <tr data-entry-id="{{ $instalar->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Ano:</strong> {{ $instalar->ano ?? 'Não atribuido' }} </p>
                                <p> <strong>Função:</strong> @foreach($instalar->funcaos as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach </p>
                                <p> <strong>Profissional:</strong> {{ $instalar->profissional->nome_completo ?? 'Não atribuido' }} </p>
                                <p> <strong>Instituição:</strong> {{ $instalar->instituicao->name ?? 'Não atribuido' }} </p>
                                <p class="cad">
                                cadastrado em {{ $instalar->created_at ?? '' }} por {{ $instalar->assinatura->name ?? '' }} de {{ $instalar->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $instalar->ano ?? '' }}
                            </td>
                            <td class="invisib">
                              @foreach($instalar->funcaos as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach
                            </td>
                            <td class="invisib">
                                {{ $instalar->instituicao->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $instalar->profissional->nome_completo ?? 'Não atribuido' }} </p>
                            </td>
                            <td class="invisib">
                                {{ $instalar->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $instalar->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $instalar->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                                <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $instalar->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $instalar->id }}" class="dropdown-content">
                                  @can('instalar_show') <a href="{{ route('admin.instalars.show', $instalar->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
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

                                function showDropdown{{ $instalar->id }}() {
                                document.getElementById("myDropdown{{ $instalar->id }}").classList.toggle("dshow");
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
@can('instalar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.instalars.massDestroy') }}",
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
  let table = $('.datatable-Instalar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
