@extends('layouts.admin')
@section('content')
@can('saida_no_estoque_create')

    <div class="contein">
      <form method="GET" action="{{ route('admin.saida-no-estoques.create') }}">

    <div class="form-group">
      <select class="form-control selectd" name="estoque" id="estoque" required>
          <option value=""> Selecione Estoque </option>
          @foreach($estoques as $estoque)
              <option value="{{ $estoque->id }}">{{ $estoque->titulo }}</option>
          @endforeach
      </select>
    </div>

        <div style="margin-bottom: 10px;" class="row"> <div class="col-lg-12">
        <input class="btn btn-success" type="submit" value="Cadastrar Saída"> </div>
      </div>
      </form>
      </div>

@endcan
<div class="card">
    <div class="card-header">
        Registros de Saídas Nos Estoques
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-SaidaNoEstoque">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.saidaNoEstoque.fields.estoque') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidaNoEstoque.fields.produto') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidaNoEstoque.fields.quatidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidaNoEstoque.fields.requisitante') }}
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
                    @foreach($saidaNoEstoques as $key => $saidaNoEstoque)
                        <tr data-entry-id="{{ $saidaNoEstoque->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Estoque:</strong> {{ $saidaNoEstoque->estoque->titulo ?? '' }} </p>
                              <p> <strong>Produto:</strong> {{ $saidaNoEstoque->produto->titulo ?? '' }} </p>
                              <p> <strong>Quantidade:</strong> {{ $saidaNoEstoque->quatidade ?? '' }} </p>
                              <p> <strong>Requisitante:</strong> {{ $saidaNoEstoque->requisitante->nome ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $saidaNoEstoque->created_at ?? '' }} por {{ $saidaNoEstoque->assinatura->name ?? '' }} de {{ $saidaNoEstoque->team->name ?? '' }}
                              </p>
                           </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->estoque->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->produto->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->quatidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->requisitante->nome ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $saidaNoEstoque->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $saidaNoEstoque->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $saidaNoEstoque->id }}" class="dropdown-content">
                              @can('saida_no_estoque_show') <a href="{{ route('admin.saida-no-estoques.show', $saidaNoEstoque->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('saida_no_estoque_edit') <a href="{{ route('admin.saida-no-estoques.edit', $saidaNoEstoque->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('saida_no_estoque_delete') <form id="delete-{{ $saidaNoEstoque->id }}" action="{{ route('admin.saida-no-estoques.destroy', $saidaNoEstoque->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $saidaNoEstoque->id }}').submit()">
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

                            function showDropdown{{ $saidaNoEstoque->id }}() {
                            document.getElementById("myDropdown{{ $saidaNoEstoque->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/saida-no-estoque.css') }}">

<script type="text/javascript">

setTimeout(function() {
   $('.alert').fadeOut('fast');
}, 20000);

</script>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('saida_no_estoque_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.saida-no-estoques.massDestroy') }}",
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
  let table = $('.datatable-SaidaNoEstoque:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
