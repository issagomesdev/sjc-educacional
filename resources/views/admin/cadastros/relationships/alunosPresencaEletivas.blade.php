@can('presenca_eletiva_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.presenca-eletivas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.presencaEletiva.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.presencaEletiva.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-alunosPresencaEletivas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.data') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.disciplina') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.bimestre') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.turmas') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.selecione_falta') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.selecionar_motivo') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presencaEletivas as $key => $presencaEletiva)
                        <tr data-entry-id="{{ $presencaEletiva->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $presencaEletiva->data ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->disciplina->nome_da_materia ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PresencaEletiva::BIMESTRE_SELECT[$presencaEletiva->bimestre] ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->turmas->ano_serie ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PresencaEletiva::SELECIONE_FALTA_RADIO[$presencaEletiva->selecione_falta] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PresencaEletiva::SELECIONAR_MOTIVO_SELECT[$presencaEletiva->selecionar_motivo] ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $presencaEletiva->created_at ?? '' }}
                            </td>
                            <td>
                                @can('presenca_eletiva_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.presenca-eletivas.show', $presencaEletiva->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('presenca_eletiva_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.presenca-eletivas.edit', $presencaEletiva->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('presenca_eletiva_delete')
                                    <form action="{{ route('admin.presenca-eletivas.destroy', $presencaEletiva->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('presenca_eletiva_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.presenca-eletivas.massDestroy') }}",
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
  let table = $('.datatable-alunosPresencaEletivas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection