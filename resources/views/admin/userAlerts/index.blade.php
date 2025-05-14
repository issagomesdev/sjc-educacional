@extends('layouts.admin')
@section('content')
@can('user_alert_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-alerts.create') }}">
                Criar Comunicado
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Comunicados
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-UserAlert">
                <thead>
                    <tr>
                        <th class="noExport" width="10">

                        </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.userAlert.fields.alert_text') }}
                        </th>
                        <th>
                            Por:
                        </th>
                        <th>
                            De:
                        </th>
                        <th>
                            Em:
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userAlerts as $key => $userAlert)
                        <tr data-entry-id="{{ $userAlert->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Titulo:</strong> {{ $userAlert->alert_text ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $userAlert->created_at ?? '' }} por {{ $userAlert->assinatura->name ?? '' }} de {{ $userAlert->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $userAlert->alert_text ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $userAlert->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $userAlert->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $userAlert->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $userAlert->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $userAlert->id }}" class="dropdown-content">
                                  @can('user_alert_show') <a href="{{ route('admin.user-alerts.show', $userAlert->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                  @can('user_alert_edit') <a href="{{ route('admin.user-alerts.edit', $userAlert->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                  @can('user_alert_delete') <form id="delete-{{ $userAlert->id }}" action="{{ route('admin.user-alerts.destroy', $userAlert->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $userAlert->id }}').submit()">
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

                                function showDropdown{{ $userAlert->id }}() {
                                document.getElementById("myDropdown{{ $userAlert->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/user-alerts.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_alert_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-alerts.massDestroy') }}",
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
  let table = $('.datatable-UserAlert:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
