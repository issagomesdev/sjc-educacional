@can('transferencium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transferencia.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transferencium.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.transferencium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-alunoTransferencia">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.aluno') }}
                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.transferencium.fields.updated_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transferencia as $key => $transferencium)
                        <tr data-entry-id="{{ $transferencium->id }}">
                            <td>

                            </td>
                            <td>
                                @foreach($transferencium->alunos as $key => $item)
                                    <span class="badge badge-info">{{ $item->nome_completo }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $transferencium->escola->name ?? '' }}
                            </td>
                            <td>
                                @foreach($transferencium->turmas as $key => $item)
                                    <span class="badge badge-info">{{ $item->ano_serie }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $transferencium->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $transferencium->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $transferencium->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('transferencium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transferencia.show', $transferencium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('transferencium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transferencia.edit', $transferencium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('transferencium_delete')
                                    <form action="{{ route('admin.transferencia.destroy', $transferencium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transferencium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transferencia.massDestroy') }}",
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
  let table = $('.datatable-alunoTransferencia:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection