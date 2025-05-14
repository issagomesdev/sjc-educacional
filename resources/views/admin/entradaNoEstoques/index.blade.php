@extends('layouts.admin')
@section('content')
@can('entrada_no_estoque_create')

    <div class="contein">
      <form method="GET" action="{{ route('admin.entrada-no-estoques.create') }}">

    <div class="form-group">
      <select class="form-control selectd" name="estoque" id="estoque" required>
          <option value=""> Selecione Estoque </option>
          @foreach($estoques as $estoque)
              <option value="{{ $estoque->id }}">{{ $estoque->titulo }}</option>
          @endforeach
      </select>
    </div>

        <div style="margin-bottom: 10px;" class="row"> <div class="col-lg-12">
        <input class="btn btn-success" type="submit" value="Cadastrar Entrada"> </div>
      </div>
      </form>
      </div>

@endcan
<div class="card">
    <div class="card-header">
        Registros de Entradas No Estoque
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-EntradaNoEstoque">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.entradaNoEstoque.fields.estoque') }}
                        </th>
                        <th>
                            {{ trans('cruds.entradaNoEstoque.fields.produto') }}
                        </th>
                        <th>
                            {{ trans('cruds.entradaNoEstoque.fields.quatidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.entradaNoEstoque.fields.fornecedor') }}
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
                        <td> <p class="fil"> Estoques </p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($estoques as $key => $item)
                                    <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil"> Produto </p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($produtos as $key => $item)
                                    <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entradaNoEstoques as $key => $entradaNoEstoque)
                        <tr data-entry-id="{{ $entradaNoEstoque->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Estoque:</strong> {{ $entradaNoEstoque->estoque->titulo ?? '' }} </p>
                              <p> <strong>Produto:</strong> {{ $entradaNoEstoque->produto->titulo ?? '' }} </p>
                              <p> <strong>Quantidade:</strong> {{ $entradaNoEstoque->quatidade ?? '' }} </p>
                              <p> <strong>Fornecedor:</strong> {{ $entradaNoEstoque->fornecedor->nome ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $entradaNoEstoque->created_at ?? '' }} por {{ $entradaNoEstoque->assinatura->name ?? '' }} de {{ $entradaNoEstoque->team->name ?? '' }}
                              </p>
                           </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->estoque->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->produto->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->quatidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->fornecedor->nome ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $entradaNoEstoque->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $entradaNoEstoque->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $entradaNoEstoque->id }}" class="dropdown-content">
                              @can('entrada_no_estoque_show') <a href="{{ route('admin.entrada-no-estoques.show', $entradaNoEstoque->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('entrada_no_estoque_edit') <a href="{{ route('admin.entrada-no-estoques.edit', $entradaNoEstoque->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('entrada_no_estoque_delete') <form id="delete-{{ $entradaNoEstoque->id }}" action="{{ route('admin.entrada-no-estoques.destroy', $entradaNoEstoque->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $entradaNoEstoque->id }}').submit()">
                              <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                              </div>
                            </div>
                            </div>
                            </td>
                            </tr>
                            @section('scripts')
                            @parent
                            <script>

                            function changeLanguage(language) {
                            var element = document.getElementById("url");
                            element.value = language;
                            element.innerHTML = language;
                            }

                            function showDropdown{{ $entradaNoEstoque->id }}() {
                            document.getElementById("myDropdown{{ $entradaNoEstoque->id }}").classList.toggle("dshow");
                            }

                            // Close the dropdown if the user clicks outside of it
                            window.onclick = function(event) {
                            if (!event.target.matches(".dropbtn")) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains("dshow")) {
                              openDropdown.classList.remove("dshow");
                            }
                            }
                            }
                            };

                            </script>
                            @endsection
                            @endforeach
                            </tbody>
                            </table>
                            </div>
                            </div>
                            </div>


<link rel="stylesheet" href="{{ url('css/panel.css') }}">
<link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
<link rel="stylesheet" href="{{ url('resources/entrada-no-estoque.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('entrada_no_estoque_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entrada-no-estoques.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-EntradaNoEstoque:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
