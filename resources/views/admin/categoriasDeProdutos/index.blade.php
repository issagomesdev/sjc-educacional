@extends('layouts.admin')
@section('content')
@can('categorias_de_produto_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.categorias-de-produtos.create') }}">
                Cadastrar Categoria
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Categorias de Produtos
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-CategoriasDeProduto">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                        <th>
                            {{ trans('cruds.categoriasDeProduto.fields.titulo') }}
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
                </thead>
                <tbody>
                    @foreach($categoriasDeProdutos as $key => $categoriasDeProduto)
                        <tr data-entry-id="{{ $categoriasDeProduto->id }}">
                          <td> </td>
                          <td>
                              <p> <strong>Titulo:</strong> {{ $categoriasDeProduto->titulo ?? '' }} </p>
                              <p class="cad">
                              cadastrado em {{ $categoriasDeProduto->created_at ?? '' }} por {{ $categoriasDeProduto->assinatura->name ?? '' }} de {{ $categoriasDeProduto->team->name ?? '' }}
                              </p>
                          </td>
                            <td class="invisib">
                                {{ $categoriasDeProduto->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $categoriasDeProduto->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $categoriasDeProduto->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $categoriasDeProduto->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $categoriasDeProduto->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $categoriasDeProduto->id }}" class="dropdown-content">
                              @can('categorias_de_produto_show') <a href="{{ route('admin.categorias-de-produtos.show', $categoriasDeProduto->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('categorias_de_produto_edit') <a href="{{ route('admin.categorias-de-produtos.edit', $categoriasDeProduto->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('categorias_de_produto_delete') <form id="delete-{{ $categoriasDeProduto->id }}" action="{{ route('admin.categorias-de-produtos.destroy', $categoriasDeProduto->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $categoriasDeProduto->id }}').submit()">
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

                            function showDropdown{{ $categoriasDeProduto->id }}() {
                            document.getElementById("myDropdown{{ $categoriasDeProduto->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/categorias-de-produtos.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('categorias_de_produto_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categorias-de-produtos.massDestroy') }}",
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
  let table = $('.datatable-CategoriasDeProduto:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
