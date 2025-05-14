@can('matricula_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.matriculas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.matricula.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.matricula.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-turmaMatriculas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.aluno') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.matricula.fields.updated_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriculas as $key => $matricula)
                        <tr data-entry-id="{{ $matricula->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $matricula->ano ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->aluno->nome_completo ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->turma->ano_serie ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $matricula->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('matricula_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.matriculas.show', $matricula->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('matricula_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.matriculas.edit', $matricula->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('matricula_delete')
                                    <form action="{{ route('admin.matriculas.destroy', $matricula->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('matricula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.matriculas.massDestroy') }}",
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
  let table = $('.datatable-turmaMatriculas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection