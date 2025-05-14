@can('cadastro_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastros.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cadastro.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cadastro.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-emailDoAlunoCadastros">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.foto_do_aluno') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.nome_completo') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.team') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastros as $key => $cadastro)
                        <tr data-entry-id="{{ $cadastro->id }}">
                            <td>

                            </td>
                            <td>
                                @if($cadastro->foto_do_aluno)
                                    <a href="{{ $cadastro->foto_do_aluno->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $cadastro->foto_do_aluno->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $cadastro->nome_completo ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Cadastro::LOCALIZACAO_RADIO[$cadastro->localizacao] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Cadastro::ESTADO_SELECT[$cadastro->estado] ?? '' }}
                            </td>
                            <td>
                                {{ $cadastro->cidade ?? '' }}
                            </td>
                            <td>
                                {{ $cadastro->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastro->turma->ano_serie ?? '' }}
                            </td>
                            <td>
                                {{ $cadastro->team->name ?? '' }}
                            </td>
                            <td>
                                @can('cadastro_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cadastros.show', $cadastro->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cadastro_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cadastros.edit', $cadastro->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cadastro_delete')
                                    <form action="{{ route('admin.cadastros.destroy', $cadastro->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cadastro_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastros.massDestroy') }}",
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
  let table = $('.datatable-emailDoAlunoCadastros:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection