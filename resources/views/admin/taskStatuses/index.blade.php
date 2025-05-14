@extends('layouts.admin')
@section('content')
@can('task_status_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.task-statuses.create') }}">
                Criar Progresso
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Progressos do Calendário
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-TaskStatus">
                <thead>
                    <tr>
                        <th width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.taskStatus.fields.name') }}
                        </th>
                        <th>
                            Cor
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
                        <th class="noExport"> </th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskStatuses as $key => $taskStatus)
                    <div class="escurece">
                        <tr class="m_esc" data-entry-id="{{ $taskStatus->id }}">
                            <td> </td>
                            <td>
                              <p> <strong>Titulo:</strong> {{ $taskStatus->name ?? '' }} </p>
                              <p> <strong>Cor:</strong>
                              <label class="taskColor"
                              style="width: 50px;
                              height: 15px;
                              margin-bottom: -4px;
                              background: {{$taskStatus->color}};
                              border: inset;
                              position: relative;">  </label>
                            </p>
                                <p class="cad">
                                cadastrado em {{ $taskStatus->created_at ?? '' }} por {{ $taskStatus->assinatura->name ?? '' }} de {{ $taskStatus->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $taskStatus->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $taskStatus->color ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $taskStatus->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $taskStatus->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $taskStatus->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $taskStatus->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $taskStatus->id }}" class="dropdown-content">
                              @can('task_status_show') <a href="{{ route('admin.task-statuses.show', $taskStatus->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('task_status_edit') <a href="{{ route('admin.task-statuses.edit', $taskStatus->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('task_status_delete') <form id="delete-{{ $taskStatus->id }}" action="{{ route('admin.task-statuses.destroy', $taskStatus->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $taskStatus->id }}').submit()">
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

                      function showDropdown{{ $taskStatus->id }}() {
                        document.getElementById("myDropdown{{ $taskStatus->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/tasks.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('task_status_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.task-statuses.massDestroy') }}",
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
  let table = $('.datatable-TaskStatus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
