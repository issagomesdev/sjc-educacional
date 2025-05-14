@extends('layouts.admin')
@section('content')
@can('estoque_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.estoques.create') }}">
                Cadastrar Estoque
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Estoques
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Estoque">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.estoque.fields.titulo') }}
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
                    @foreach($estoques as $key => $estoque)
                        <tr data-entry-id="{{ $estoque->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Titulo:</strong> {{ $estoque->titulo ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $estoque->created_at ?? '' }} por {{ $estoque->assinatura->name ?? '' }} de {{ $estoque->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $estoque->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $estoque->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $estoque->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $estoque->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $estoque->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $estoque->id }}" class="dropdown-content">
                              @can('estoque_show') <a href="{{ route('admin.estoques.show', $estoque->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('estoque_edit') <a href="{{ route('admin.estoques.edit', $estoque->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('estoque_delete') <form id="delete-{{ $estoque->id }}" action="{{ route('admin.estoques.destroy', $estoque->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $estoque->id }}').submit()">
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

                            function showDropdown{{ $estoque->id }}() {
                            document.getElementById("myDropdown{{ $estoque->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/estoques.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('estoque_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.estoques.massDestroy') }}",
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
  let table = $('.datatable-Estoque:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
