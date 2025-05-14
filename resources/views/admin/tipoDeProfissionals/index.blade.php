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

@can('tipo_de_profissional_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tipo-de-profissionals.create') }}">
                Cadastrar Tipo de Profissional
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Tipos De Profissional
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-TipoDeProfissional">
                <thead>
                    <tr>
                        <th class="noExport" width="10"></th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.tipoDeProfissional.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.tipoDeProfissional.fields.sobre') }}
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
                </thead>
                <tbody>
                    @foreach($tipoDeProfissionals as $key => $tipoDeProfissional)
                        <tr data-entry-id="{{ $tipoDeProfissional->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Titulo:</strong> {{ $tipoDeProfissional->titulo ?? '' }} </p>
                                <p> <strong>Sobre:</strong> {{ $tipoDeProfissional->sobre ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $tipoDeProfissional->created_at ?? '' }} por {{ $tipoDeProfissional->assinatura->name ?? '' }} de {{ $tipoDeProfissional->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $tipoDeProfissional->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $tipoDeProfissional->sobre ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $tipoDeProfissional->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $tipoDeProfissional->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $tipoDeProfissional->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $tipoDeProfissional->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $tipoDeProfissional->id }}" class="dropdown-content">
                                  @can('tipo_de_profissional_show') <a href="{{ route('admin.tipo-de-profissionals.show', $tipoDeProfissional->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                  @can('tipo_de_profissional_edit') <a href="{{ route('admin.tipo-de-profissionals.edit', $tipoDeProfissional->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                  @can('tipo_de_profissional_delete') <form id="delete-{{ $tipoDeProfissional->id }}" action="{{ route('admin.tipo-de-profissionals.destroy', $tipoDeProfissional->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $tipoDeProfissional->id }}').submit()">
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

                                function showDropdown{{ $tipoDeProfissional->id }}() {
                                document.getElementById("myDropdown{{ $tipoDeProfissional->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/tipo-de-profissionals.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tipo_de_profissional_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tipo-de-profissionals.massDestroy') }}",
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
  let table = $('.datatable-TipoDeProfissional:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
