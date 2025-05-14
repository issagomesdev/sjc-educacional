@can('cadastrar_biblioteca_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrar-bibliotecas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cadastrarBiblioteca.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cadastrarBiblioteca.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-assinaturaCadastrarBibliotecas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.nome_da_biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_1_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarBibliotecas as $key => $cadastrarBiblioteca)
                        <tr data-entry-id="{{ $cadastrarBiblioteca->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->nome_da_biblioteca ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO[$cadastrarBiblioteca->localizacao] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CadastrarBiblioteca::ESTADO_SELECT[$cadastrarBiblioteca->estado] ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->cidade ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->horario_1_2 ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarBiblioteca->created_at ?? '' }}
                            </td>
                            <td>
                                @can('cadastrar_biblioteca_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cadastrar-bibliotecas.show', $cadastrarBiblioteca->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cadastrar_biblioteca_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cadastrar-bibliotecas.edit', $cadastrarBiblioteca->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cadastrar_biblioteca_delete')
                                    <form action="{{ route('admin.cadastrar-bibliotecas.destroy', $cadastrarBiblioteca->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cadastrar_biblioteca_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrar-bibliotecas.massDestroy') }}",
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
  let table = $('.datatable-assinaturaCadastrarBibliotecas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection