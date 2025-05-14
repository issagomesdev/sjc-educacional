@can('documento_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.documentos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.documento.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.documento.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-assinaturaDocumentos">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.documento.fields.nome') }}
                        </th>
                        <th>
                            {{ trans('cruds.documento.fields.instituicao') }}
                        </th>
                        <th>
                            {{ trans('cruds.documento.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.documento.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.documento.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $key => $documento)
                        <tr data-entry-id="{{ $documento->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $documento->nome ?? '' }}
                            </td>
                            <td>
                                {{ $documento->instituicao->name ?? '' }}
                            </td>
                            <td>
                                {{ $documento->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $documento->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $documento->created_at ?? '' }}
                            </td>
                            <td>
                                @can('documento_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.documentos.show', $documento->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('documento_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.documentos.edit', $documento->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('documento_delete')
                                    <form action="{{ route('admin.documentos.destroy', $documento->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('documento_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.documentos.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-assinaturaDocumentos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection