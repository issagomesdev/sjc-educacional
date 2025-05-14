@can('vaga_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vagas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vaga.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.vaga.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-turmaVagas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.turma.fields.nivel_da_turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.total_de_vadas') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.vagas_preenchidas') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaga.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vagas as $key => $vaga)
                        <tr data-entry-id="{{ $vaga->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vaga->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ $vaga->turma->ano_serie ?? '' }}
                            </td>
                            <td>
                                @if($vaga->turma)
                                    {{ $vaga->turma::NIVEL_DA_TURMA_RADIO[$vaga->turma->nivel_da_turma] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $vaga->total_de_vadas ?? '' }}
                            </td>
                            <td>
                                {{ $vaga->vagas_preenchidas ?? '' }}
                            </td>
                            <td>
                                {{ $vaga->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $vaga->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $vaga->created_at ?? '' }}
                            </td>
                            <td>
                                @can('vaga_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vagas.show', $vaga->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('vaga_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vagas.edit', $vaga->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('vaga_delete')
                                    <form action="{{ route('admin.vagas.destroy', $vaga->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vaga_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vagas.massDestroy') }}",
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
  let table = $('.datatable-turmaVagas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection