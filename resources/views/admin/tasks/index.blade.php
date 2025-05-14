@extends('layouts.admin')
<title> Eventos </title>
@section('content')
@can('task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                Criar Evento
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Registros de Eventos do Calendário
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Task">
                <thead>
                    <tr>
                        <th width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.tag') }}
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
                    @foreach($tasks as $key => $task)
                    <div class="escurece">
                        <tr class="m_esc" data-entry-id="{{ $task->id }}">
                            <td> </td>
                            <td>
                              <p> <strong>Titulo:</strong>  {{ $task->name ?? '' }} </p>
                              <p> <strong>Progresso:</strong> {{ $task->status->name ?? '' }} </p>
                              <p> <strong>Categoria:</strong> @foreach($task->tags as $key => $item) <span class="badge badge-info">{{ $item->name }}</span> @endforeach </p>
                                <p class="cad">
                                cadastrado em {{ $task->created_at ?? '' }} por {{ $task->assinatura->name ?? '' }} de {{ $task->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $task->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $task->status->name ?? '' }}
                            </td>
                            <td class="invisib">
                                @foreach($task->tags as $key => $item) <span class="badge badge-info">{{ $item->name }}</span> @endforeach
                            </td>
                            <td class="invisib">
                                {{ $task->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $task->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $task->created_at ?? '' }}
                            </td>

                            <td class="btnn">
                              <div class="header">
                              <div class="dropdown">
                                <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $task->id }}()"> <li></li> <li></li> <li></li> </ul>
                                <div id="myDropdown{{ $task->id }}" class="dropdown-content">
                                @can('task_show') <a href="{{ route('admin.tasks.show', $task->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                @can('task_edit') <a href="{{ route('admin.tasks.edit', $task->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                @can('task_delete') <form id="delete-{{ $task->id }}" action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $task->id }}').submit()">
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

                        function showDropdown{{ $task->id }}() {
                          document.getElementById("myDropdown{{ $task->id }}").classList.toggle("dshow");
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
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
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
  let table = $('.datatable-Task:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
