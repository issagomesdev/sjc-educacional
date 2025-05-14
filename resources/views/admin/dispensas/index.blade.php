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

@can('dispensa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.dispensas.create') }}">
                Dispensar Turma
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Regsitros de Dispensa de Turmas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Dispensa">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.dispensa.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.dispensa.fields.tipo_de_dispensa') }}
                        </th>
                        <th>
                            {{ trans('cruds.dispensa.fields.motivo') }}
                        </th>
                        <th>
                            {{ trans('cruds.dispensa.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.dispensa.fields.turma') }}
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
                        <td> <p class="fil">Tipo de Dispensa</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Dispensa::TIPO_DE_DISPENSA_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Turma</p>
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
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispensas as $key => $dispensa)
                        <tr data-entry-id="{{ $dispensa->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Ano:</strong> {{ $dispensa->ano ?? '' }} </p>
                                <p> <strong>Tipo de dispensa:</strong> {{ App\Models\Dispensa::TIPO_DE_DISPENSA_RADIO[$dispensa->tipo_de_dispensa] ?? '' }} </p>
                                <p> <strong>Motivo:</strong> {{ $dispensa->motivo ?? '' }} </p>
                                <p> <strong>Escola</strong> {{ $dispensa->escola->name ?? '' }} </p>
                                <p> <strong>Turma</strong> {{ $dispensa->turma->serie ?? '' }} {{ $dispensa->turma->identificacao ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $dispensa->created_at ?? '' }} por {{ $dispensa->assinatura->name ?? '' }} de {{ $dispensa->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $dispensa->ano ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Dispensa::TIPO_DE_DISPENSA_RADIO[$dispensa->tipo_de_dispensa] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->motivo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->escola->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->turma->serie ?? '' }} {{ $dispensa->turma->identificacao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $dispensa->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $dispensa->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $dispensa->id }}" class="dropdown-content">
                                   @can('dispensa_show') <a href="{{ route('admin.dispensas.show', $dispensa->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('dispensa_edit') <a href="{{ route('admin.dispensas.edit', $dispensa->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('dispensa_delete') <form id="delete-{{ $dispensa->id }}" action="{{ route('admin.dispensas.destroy', $dispensa->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $dispensa->id }}').submit()">
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

                                function showDropdown{{ $dispensa->id }}() {
                                document.getElementById("myDropdown{{ $dispensa->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/dispensas.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('dispensa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dispensas.massDestroy') }}",
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
  let table = $('.datatable-Dispensa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
