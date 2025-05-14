@can('cadastrar_livro_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrar-livros.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cadastrarLivro.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cadastrarLivro.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bibliotecaCadastrarLivros">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.autor') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.idioma') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.editora') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.genero') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.selecione') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarLivros as $key => $cadastrarLivro)
                        <tr data-entry-id="{{ $cadastrarLivro->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cadastrarLivro->titulo ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->autor ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->idioma ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->biblioteca->nome_da_biblioteca ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->ano ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->editora ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CadastrarLivro::GENERO_SELECT[$cadastrarLivro->genero] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CadastrarLivro::SELECIONE_RADIO[$cadastrarLivro->selecione] ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $cadastrarLivro->created_at ?? '' }}
                            </td>
                            <td>
                                @can('cadastrar_livro_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cadastrar-livros.show', $cadastrarLivro->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cadastrar_livro_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cadastrar-livros.edit', $cadastrarLivro->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cadastrar_livro_delete')
                                    <form action="{{ route('admin.cadastrar-livros.destroy', $cadastrarLivro->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cadastrar_livro_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastrar-livros.massDestroy') }}",
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
  let table = $('.datatable-bibliotecaCadastrarLivros:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection