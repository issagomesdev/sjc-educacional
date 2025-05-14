@can('quadro_de_horario_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.quadro-de-horarios.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.quadroDeHorario.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.quadroDeHorario.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-anoSerieQuadroDeHorarios">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.ano_serie') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.periodo') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.dias') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.horario') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.materias') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.professor') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.quadroDeHorario.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quadroDeHorarios as $key => $quadroDeHorario)
                        <tr data-entry-id="{{ $quadroDeHorario->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $quadroDeHorario->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->ano_serie->ano_serie ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\QuadroDeHorario::PERIODO_RADIO[$quadroDeHorario->periodo] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\QuadroDeHorario::DIAS_RADIO[$quadroDeHorario->dias] ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->horario ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->materias->nome_da_materia ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->professor->nome_completo ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->created_at ?? '' }}
                            </td>
                            <td>
                                @can('quadro_de_horario_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.quadro-de-horarios.show', $quadroDeHorario->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('quadro_de_horario_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.quadro-de-horarios.edit', $quadroDeHorario->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('quadro_de_horario_delete')
                                    <form action="{{ route('admin.quadro-de-horarios.destroy', $quadroDeHorario->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('quadro_de_horario_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.quadro-de-horarios.massDestroy') }}",
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
  let table = $('.datatable-anoSerieQuadroDeHorarios:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
