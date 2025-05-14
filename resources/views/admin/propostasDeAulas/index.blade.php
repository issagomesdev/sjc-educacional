@extends('layouts.admin')
@section('content')
@can('propostas_de_aula_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.propostas-de-aulas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.propostasDeAula.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.propostasDeAula.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PropostasDeAula">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.propostasDeAula.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.autor') }}
                        </th>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.publico_alvo') }}
                        </th>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.area_de_conhecimento') }}
                        </th>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.situacao_do_projeto') }}
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
                        <th class="noExport"> </th>
                        <th class="noExport"> </th>
                        <th class="noExport"> </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                      <td> </td>
                      <td> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td></td>
                        <td> <p class="fil">Publico Alvo</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\PropostasDeAula::PUBLICO_ALVO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Situação da Proposta</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\PropostasDeAula::SITUACAO_DO_PROJETO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                          <td> </td>
                          <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($propostasDeAulas as $key => $propostasDeAula)
                        <tr data-entry-id="{{ $propostasDeAula->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Titulo:</strong> {{ $propostasDeAula->titulo ?? '' }} </p>
                              <p> <strong>Autor:</strong> {{ $propostasDeAula->autor ?? '' }} </p>
                              <p> <strong>Publico Alvo:</strong> {{ App\Models\PropostasDeAula::PUBLICO_ALVO_SELECT[$propostasDeAula->publico_alvo] ?? '' }} </p>
                              <p> <strong>Situação da Proposta:</strong> {{ App\Models\PropostasDeAula::SITUACAO_DO_PROJETO_SELECT[$propostasDeAula->situacao_do_projeto] ?? 'Pedente' }} </p>
                              <p> <strong>Área de conhecimento:</strong> {{ $propostasDeAula->area_de_conhecimento ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $propostasDeAula->created_at ?? '' }} por {{ $propostasDeAula->assinatura->name ?? '' }} de {{ $propostasDeAula->team->name ?? '' }}
                              </p>
                          </td>
                          <td class=""> </td>
                            <td class="invisib">
                                {{ $propostasDeAula->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $propostasDeAula->autor ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\PropostasDeAula::PUBLICO_ALVO_SELECT[$propostasDeAula->publico_alvo] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $propostasDeAula->area_de_conhecimento ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\PropostasDeAula::SITUACAO_DO_PROJETO_SELECT[$propostasDeAula->situacao_do_projeto] ?? 'Pedente' }}
                            </td>
                            <td class="invisib">
                                {{ $propostasDeAula->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $propostasDeAula->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $propostasDeAula->created_at ?? '' }}
                            </td>
                            <td></td>
                            <td></td>
                            <td class="ok">
                                <form method="POST" action="{{ route("admin.propostas-de-aulas.update", [$propostasDeAula->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-g">
                                    <label>{{ trans('cruds.propostasDeAula.fields.situacao_do_projeto') }}</label>
                                    <select class="form-control {{ $errors->has('situacao_do_projeto') ? 'is-invalid' : '' }}" name="situacao_do_projeto" id="situacao_do_projeto">
                                        <option value disabled {{ old('situacao_do_projeto', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\PropostasDeAula::SITUACAO_DO_PROJETO_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('situacao_do_projeto', $propostasDeAula->situacao_do_projeto) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('situacao_do_projeto'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('situacao_do_projeto') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.propostasDeAula.fields.situacao_do_projeto_helper') }}</span>
                                </div>

                                <div class="form-g2">
                                    <button class="btn btn-danger" type="submit">
                                        Registrar Resposta
                                    </button>
                                </div>

                                </form>
                          </td>
                              <td class="btnn">
                                @can('propostas_de_aula_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.propostas-de-aulas.show', $propostasDeAula->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('propostas_de_aula_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.propostas-de-aulas.edit', $propostasDeAula->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('propostas_de_aula_delete')
                                    <form action="{{ route('admin.propostas-de-aulas.destroy', $propostasDeAula->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@endsection
@section('styles')
<style>

.datatable {
  width: 100% !important;
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

.btn {
margin-left: -10px;
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
opacity: 70%;
}

p.esc {
font-size: 12px;
}

td.d {
    display: none;
}

td.invisib {
    display: none;
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

table.dataTable tbody td.btnn {
    padding-right: 5000px;
    padding-left: 120px;
    padding-top: 50px;
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

th.sorting {
    width: 00px;
}

.table-bordered, .table-bordered td, .table-bordered th {
  border: 0px solid;
  border-color: #d8dbe0;
}


.form-g2 {
    margin: 10px 30px 0px 30px;
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

p.resp {
    font-size: 11px;
    opacity: 100%;
}

.dataTables_scrollBody {
    position: relative;
    overflow: hidden !important;
    width: 100%;
}

.dataTables_wrapper.no-footer .dataTables_scrollBody {
    border-bottom: 1px solid #c8ced3;
}


a.btn.buttons-collection.buttons-colvis.btn-default {
    padding: 0px 0px 0px 0px;
    width: 0%;
    opacity: 0%;
    margin: 210px 0px 0px 0px;
    position: absolute;
}

button.btn.btn-ok {
    color: #fff;
    background-color: #ffd84a;
    border-color: #ffd84a;
}

</style>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('propostas_de_aula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.propostas-de-aulas.massDestroy') }}",
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
  let table = $('.datatable-PropostasDeAula:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
