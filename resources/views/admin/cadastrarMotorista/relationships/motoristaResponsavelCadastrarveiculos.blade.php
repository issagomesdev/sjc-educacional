@can('cadastrarveiculo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrarveiculos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cadastrarveiculo.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cadastrarveiculo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-motoristaResponsavelCadastrarveiculos">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.niv') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.placa') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.renavam') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.marca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.instituicao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.motorista_responsavel') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.situacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarveiculos as $key => $cadastrarveiculo)
                        <tr data-entry-id="{{ $cadastrarveiculo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cadastrarveiculo->niv ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->placa ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->renavam ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->marca ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->instituicao->name ?? '' }}
                            </td>
                            <td>
                                @foreach($cadastrarveiculo->motorista_responsavels as $key => $item)
                                    <span class="badge badge-info">{{ $item->nome_completo }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\Cadastrarveiculo::SITUACAO_SELECT[$cadastrarveiculo->situacao] ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarveiculo->created_at ?? '' }}
                            </td>
                            <td>
                                @can('cadastrarveiculo_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cadastrarveiculos.show', $cadastrarveiculo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cadastrarveiculo_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cadastrarveiculos.edit', $cadastrarveiculo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cadastrarveiculo_delete')
                                    <form action="{{ route('admin.cadastrarveiculos.destroy', $cadastrarveiculo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cadastrarveiculo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrarveiculos.massDestroy') }}",
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
    order: [[ 4, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-motoristaResponsavelCadastrarveiculos:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection