@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">

      @can('banco_de_projeto_access')
        <a href="{{ route("admin.banco-de-projetos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banco-de-projetos") || request()->is("admin/banco-de-projetos/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-box-open c-sidebar-nav-icon"> </i> Banco de Projetos </a> @endcan

      @can('propostas_de_projeto_access')
        <a href="{{ route("admin.projetos.propostas") }}" class="c-sidebar-nav-link {{ request()->is("admin/projetos/propostas") || request()->is("admin/projetos/propostas/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-box c-sidebar-nav-icon"> </i> Propostas de Projetos </a> @endcan

    </div>
    </div>

@can('banco_de_projeto_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banco-de-projetos.create') }}">
                Nova Proposta
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Propostas de projetos
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BancoDeProjeto">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.autor') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.publico_alvo') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.area_de_conhecimento') }}
                        </th>
                        <th>
                            Situação
                        </th>
                        <th>
                            Por:
                        </th>
                        <th>
                            De:
                        </th>
                        <th>
                            Data
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                      <td> </td>
                      <td> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Publico Alvo</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\BancoDeProjeto::PUBLICO_ALVO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Disciplina</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($materia as $key => $item)
                                    <option value="{{ $item->nome_da_materia }}">{{ $item->nome_da_materia }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Situação</p>
                          <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Em revisão">Em revisão</option>
                                <option value="Incompleto">Incompleto</option>
                                <option value="Em avaliação">Em avaliação</option>
                                <option value="Mudança Sugerida">Mudança sugerida</option>
                                <option value="Arquivo morto">Arquivo morto</option>
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bancoDeProjetos as $key => $bancoDeProjeto)
                        <tr data-entry-id="{{ $bancoDeProjeto->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Titulo:</strong> {{ $bancoDeProjeto->titulo ?? '' }} </p>
                              <p> <strong>Autor:</strong> {{ $bancoDeProjeto->autor ?? '' }} </p>
                              <p> <strong>Publico Alvo:</strong> {{ App\Models\BancoDeProjeto::PUBLICO_ALVO_SELECT[$bancoDeProjeto->publico_alvo] ?? '' }} </p>
                              <p> <strong>Área de conhecimento:</strong> @foreach($bancoDeProjeto->area_de_conhecimentos as $key => $item) <span class="badge badge-info">{{ $item->nome_da_materia }}</span> @endforeach </p>
                              <p> <strong>Situação:</strong> {{ App\Models\bancoDeProjeto::SITUACAO_DO_PROJETO_SELECT[$bancoDeProjeto->situacao_do_projeto] ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $bancoDeProjeto->created_at ?? '' }} por {{ $bancoDeProjeto->assinatura->name ?? '' }} de {{ $bancoDeProjeto->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $bancoDeProjeto->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeProjeto->autor ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\BancoDeProjeto::PUBLICO_ALVO_SELECT[$bancoDeProjeto->publico_alvo] ?? '' }}
                            </td>
                            <td class="invisib">
                                @foreach($bancoDeProjeto->area_de_conhecimentos as $key => $item) <span class="badge badge-info">{{ $item->nome_da_materia }}</span> @endforeach
                            </td>
                            <td class="invisib">
                                {{ App\Models\bancoDeProjeto::SITUACAO_DO_PROJETO_SELECT[$bancoDeProjeto->situacao_do_projeto] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeProjeto->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeProjeto->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeProjeto->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                                @can('banco_de_projeto_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.banco-de-projetos.show', $bancoDeProjeto->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('banco_de_projeto_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banco-de-projetos.edit', $bancoDeProjeto->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('banco_de_projeto_delete')
                                    <form action="{{ route('admin.banco-de-projetos.destroy', $bancoDeProjeto->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                                @can('change_bancos')
                                 <input class="btn btn-xs btn-prosp"  onclick="window.open('{{ route('admin.projetos.propostas.atualizar') }}?id={{$bancoDeProjeto->id}}','MyWindow','width=600,height=300,toolbar=no,menubar=no,location=no,status=no,scrollbars=no,resizable=no,left=383,top=234');return false;" type="submit" value="Atualizar Proposta">
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('styles')
<style>

*, *:after, *:before {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
margin: 0;
outline: 0 none;
padding: 0;
}

.menu {
cursor: pointer;
padding: 15px;
max-height: 100px;
overflow: hidden;

}

.menu .line {
height: 3px;
display: block;
width: 3px;
background: #FFF;
box-shadow: 0 1px 3px #000;
margin: 2px;
opacity: 1;
transition: all 500ms ease;
}

.menu.active .line:nth-child(1) {
height: 1000px;
width: 250px;
margin: -20px;
box-shadow: 0 0 0 rgba(1, 1, 1, 0);
}
.menu.active .line:nth-child(2),
.menu.active .line:nth-child(3) {
opacity: 0;
}
.nav {
padding: 20px;
}
.menu:not(.active) .nav li {
opacity: 0;
margin-bottom: -10px;
}
.menu .nav li {
opacity: 1;
font-size: 16px;
margin-bottom: 20px;
transition: opacity 500ms ease, margin-bottom 500ms ease, padding-left 250ms ease;
}
.menu .nav li:hover {
padding-left: 5px;
}

table.dataTable tbody td {
padding: 20px 15px;
}

p {
margin-top: 5px;
margin-bottom: -2px;
margin-right: -500px;
}

p.esc {
    margin-top: 5px;
    margin-bottom: -2px;
    margin-right: -500px;
}


p.bn {
margin-top: 2px;
margin-bottom: -1px;
margin-right: 0px;
}

input.btn.btn-xs.btn-danger {
margin-left: px;
}

img {
width: 90px;
height: auto;
}

p {
font-size: 14px;
}

p.cad {
font-size: 9px;
opacity: 50%;
}

p.esc {
font-size: 12px;
}


strong.e {
    color: white;
    background-color: #3399ff;
    padding: 0px 5px 0px 5px;
  }

strong.t {
  color: white;
  background-color: #e55353;
  padding: 0px 5px 0px 5px;
  margin: 4px;
  }


table.dataTable tbody td.invisib {
padding: 0px 0px;

}


table.dataTable tbody td.menu {
padding: 0px 0px;

}

.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td {
vertical-align: top;
}

.row {
    margin: 0px 10px 10px 0px;
}


button.btn.btn-warning {
    margin: 5px;
}

.menu {
    cursor: pointer;
    padding: 0px;
    max-height: 100px;
    overflow: hidden;
}

tbody {
    flex: 2;
}

table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
  padding: 0px;
  opacity: 0%;
  pointer-events: none;
  width: 0px !important;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 0px 0px;

}

a.btn.buttons-copy.buttons-html5.btn-default {
    display: none;
}

th.sorting {
    width: 00px;
}

.table-bordered, .table-bordered td, .table-bordered th {
  border: 0px solid;
  border-color: #d8dbe0;
}


table.dataTable thead th {
    border-bottom: 0px solid #c8ced3;

}

div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin: 30px 10px 10px 10px;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 1px 1px 20px 10px;
    border-bottom: 0px solid #111;
}

.dataTables_scrollHeadInner {

  width: 400px !important;
}


td.invisib {
    display: none;
}

.dataTables_scrollBody {
    position: relative;
    overflow: hidden !important;
    width: 0%;
}

.dataTables_wrapper.no-footer .dataTables_scrollBody {
    border-bottom: 1px solid #c8ced3;
}

p.fil {

    font-weight: 600;
}

table.dataTable tbody td.btnn2 {
    padding-top: 60px;
    padding-left: 400px;
}

table.dataTable tbody td.btnn {
    padding-right: 5000px;
    padding-left: 500px;
    padding-top: 30px;
}

a.btn.buttons-collection.buttons-colvis.btn-default {
    padding: 0px 0px 0px 0px;
    width: 0%;
    opacity: 0%;
    margin: 210px 0px 0px 0px;
    position: absolute;
}

a.btn.btn-xs.btn-m {
    color: #fff;
    background-color: #5cc975;
    border-color: #5cc975;
    height: 25px;
}

button.btn.btn-m {
    color: #fff;
    background-color: #5cc975;
    border-color: #5cc975;
}

.btn-prosp {
    color: #fff;
    background-color: #ffd84a;
    border-color: #ffd84a;
}

a.c-sidebar-nav-link {
    color: #000000c7;
}

.card-top {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    display: flex;
}

a.c-sidebar-nav-link.c-active {
    color: #2eb85c;
}

.btn {
    margin-left: 1px;
    margin-top: 3px;
}

</style>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('banco_de_projeto_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banco-de-projetos.massDestroy') }}",
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
  let table = $('.datatable-BancoDeProjeto:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
