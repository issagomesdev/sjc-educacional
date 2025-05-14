@can('rotum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.rota.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.rotum.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.rotum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-veiculoResponsavelRota">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_saida') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.origem') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_destino') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.destino') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.quilometros_percorridos') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.veiculo_responsavel') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.motorista_responsavel') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.rotum.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rota as $key => $rotum)
                        <tr data-entry-id="{{ $rotum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rotum->ano ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->horario_de_saida ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->origem ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->horario_de_destino ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->destino ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->quilometros_percorridos ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->veiculo_responsavel->descricao ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->motorista_responsavel->nome_completo ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $rotum->created_at ?? '' }}
                            </td>
                            <td>
                                @can('rotum_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.rota.show', $rotum->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('rotum_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.rota.edit', $rotum->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('rotum_delete')
                                    <form action="{{ route('admin.rota.destroy', $rotum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('rotum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rota.massDestroy') }}",
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
  let table = $('.datatable-veiculoResponsavelRota:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection