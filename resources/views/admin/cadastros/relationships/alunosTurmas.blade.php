@can('turma_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.turmas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.turma.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.turma.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-alunosTurmas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.nivel_da_turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.tipo_de_turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.ano_serie') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.turno') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turmas as $key => $turma)
                        <tr data-entry-id="{{ $turma->id }}">
                            <td>

                            </td>
                            <td>
                                {{ App\Models\Turma::NIVEL_DA_TURMA_RADIO[$turma->nivel_da_turma] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Turma::TIPO_DE_TURMA_RADIO[$turma->tipo_de_turma] ?? '' }}
                            </td>
                            <td>
                                {{ $turma->ano_serie ?? '' }}
                            </td>
                            <td>
                                {{ $turma->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Turma::TURNO_RADIO[$turma->turno] ?? '' }}
                            </td>
                            <td>
                                {{ $turma->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $turma->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $turma->created_at ?? '' }}
                            </td>
                            <td>
                                @can('turma_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.turmas.show', $turma->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('turma_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.turmas.edit', $turma->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('turma_delete')
                                    <form action="{{ route('admin.turmas.destroy', $turma->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('turma_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.turmas.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-alunosTurmas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection