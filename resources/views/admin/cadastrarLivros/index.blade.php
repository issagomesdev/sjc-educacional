@extends('layouts.admin')
@section('content')
@can('cadastrar_livro_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cadastrar-livros.create') }}">
                Cadastrar Livro
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Registros de Livros Cadastrados
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-CadastrarLivro">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                          {{ trans('cruds.cadastrarLivro.fields.biblioteca') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.genero') }}
                        </th>
                        <th>
                            Disponibilidade
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.autor') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.idioma') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.editora') }}
                        </th>
                        <th>
                            Por:
                        </th>
                        <th>
                            De:
                        </th>
                        <th>
                            Data:
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                      <td> </td>
                      <td> </td>
                        <td> <p class="fil">Biblioteca</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($cadastrar_bibliotecas as $key => $item)
                                    <option value="{{ $item->nome_da_biblioteca }}">{{ $item->nome_da_biblioteca }}</option>
                                @endforeach
                            </select>
                        </td>
                      <td class="d"> </td>
                        <td> <p class="fil">Genero</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarLivro::GENERO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Disponibilidade</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\CadastrarLivro::SELECIONE_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                          <td class="d"> </td>
                          <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastrarLivros as $key => $cadastrarLivro)
                    <div class="escurece">
                        <tr class="m_esc" data-entry-id="{{ $cadastrarLivro->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Titulo:</strong> {{ $cadastrarLivro->titulo ?? 'Não atribuído' }} </p>
                                <p> <strong>Autor:</strong> {{ $cadastrarLivro->autor ?? 'Não atribuído' }} </p>
                                <p> <strong>Idioma:</strong> {{ $cadastrarLivro->idioma ?? 'Não atribuído' }} </p>
                                <p> <strong>Ano:</strong> {{ $cadastrarLivro->ano ?? 'Não atribuído' }} </p>
                                <p> <strong>Editora:</strong> {{ $cadastrarLivro->editora ?? 'Não atribuído' }} </p>
                                <p> <strong>Genero:</strong> {{ App\Models\CadastrarLivro::GENERO_SELECT[$cadastrarLivro->genero] ?? 'Não atribuído' }} </p>
                                <p> <strong>Disponibilidade:</strong> {{ App\Models\CadastrarLivro::SELECIONE_RADIO[$cadastrarLivro->selecione] ?? 'Não atribuído' }} </p>
                                <p> <strong>Biblioteca:</strong> {{ $cadastrarLivro->biblioteca->nome_da_biblioteca ?? 'Não atribuído' }} </p>
                                <p class="cad">
                                cadastrado em {{ $cadastrarLivro->created_at ?? '' }} por {{ $cadastrarLivro->assinatura->name ?? '' }} de {{ $cadastrarLivro->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->biblioteca->nome_da_biblioteca ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->titulo ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarLivro::GENERO_SELECT[$cadastrarLivro->genero] ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\CadastrarLivro::SELECIONE_RADIO[$cadastrarLivro->selecione] ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->autor ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->idioma ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->ano ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->editora ?? 'Não atribuído' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastrarLivro->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                            <div class="header">
                            <div class="dropdown">
                              <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $cadastrarLivro->id }}()"> <li></li> <li></li> <li></li> </ul>
                              <div id="myDropdown{{ $cadastrarLivro->id }}" class="dropdown-content">
                              @can('cadastrar_livro_delete') <a href="{{ route('admin.cadastrar-livros.show', $cadastrarLivro->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                              @can('cadastrar_livro_edit') <a href="{{ route('admin.cadastrar-livros.edit', $cadastrarLivro->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                              @can('cadastrar_livro_delete') <form id="delete-{{ $cadastrarLivro->id }}" action="{{ route('admin.cadastrar-livros.destroy', $cadastrarLivro->id) }}" method="POST">  @method('DELETE') @csrf </form>
                              <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $cadastrarLivro->id }}').submit()">
                              <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                              </div>
                            </div>
                          </div>
                          </td>
                      </tr>
                    </div>
                      @section('scripts')
                      @parent
                      <script>

                      function changeLanguage(language) {
                        var element = document.getElementById("url");
                        element.value = language;
                        element.innerHTML = language;
                      }

                      function showDropdown{{ $cadastrarLivro->id }}() {
                        document.getElementById("myDropdown{{ $cadastrarLivro->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/cadastrar-livros.css') }}">

@endsection
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
  let table = $('.datatable-CadastrarLivro:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
