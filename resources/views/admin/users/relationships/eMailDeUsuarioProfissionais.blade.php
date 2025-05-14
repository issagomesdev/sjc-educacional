@can('profissionai_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.profissionais.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.profissionai.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.profissionai.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eMailDeUsuarioProfissionais">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.nome_completo') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.genero') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.estado_civil') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.ano_de_contratacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.situacao_de_contratacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.funcao') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.instituicao') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.profissionai.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profissionais as $key => $profissionai)
                        <tr data-entry-id="{{ $profissionai->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $profissionai->nome_completo ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Profissionai::GENERO_RADIO[$profissionai->genero] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Profissionai::ESTADO_CIVIL_SELECT[$profissionai->estado_civil] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Profissionai::LOCALIZACAO_RADIO[$profissionai->localizacao] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Profissionai::ESTADO_SELECT[$profissionai->estado] ?? '' }}
                            </td>
                            <td>
                                {{ $profissionai->cidade ?? '' }}
                            </td>
                            <td>
                                {{ $profissionai->ano_de_contratacao ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT[$profissionai->situacao_de_contratacao] ?? '' }}
                            </td>
                            <td>
                                @foreach($profissionai->funcaos as $key => $item)
                                    <span class="badge badge-info">{{ $item->titulo }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $profissionai->instituicao->name ?? '' }}
                            </td>
                            <td>
                                {{ $profissionai->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $profissionai->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $profissionai->created_at ?? '' }}
                            </td>
                            <td>
                                @can('profissionai_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.profissionais.show', $profissionai->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('profissionai_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.profissionais.edit', $profissionai->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('profissionai_delete')
                                    <form action="{{ route('admin.profissionais.destroy', $profissionai->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('profissionai_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.profissionais.massDestroy') }}",
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
  let table = $('.datatable-eMailDeUsuarioProfissionais:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection