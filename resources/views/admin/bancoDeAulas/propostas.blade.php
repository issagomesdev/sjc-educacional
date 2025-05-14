@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">

      @can('banco_de_aula_access')
        <a href="{{ route("admin.banco-de-aulas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banco-de-aulas") || request()->is("admin/banco-de-aulas/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-box-open c-sidebar-nav-icon"> </i> Banco de Aulas </a> @endcan

      @can('propostas_de_aula_access')
        <a href="{{ route("admin.aulas.propostas") }}" class="c-sidebar-nav-link {{ request()->is("admin/aulas/propostas") || request()->is("admin/propostas-de-aulas/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-box c-sidebar-nav-icon"> </i> Propostas de Aulas </a> @endcan

    </div>
    </div>

@can('banco_de_aula_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banco-de-aulas.create') }}">
                Nova Proposta
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Propostas de aulas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-BancoDeAula">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.bancoDeAula.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.autor') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.publico_alvo') }}
                        </th>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.area_de_conhecimento') }}
                        </th>
                        <th>
                            Situação:
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
                                @foreach(App\Models\BancoDeAula::PUBLICO_ALVO_SELECT as $key => $item)
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
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bancoDeAulas as $key => $bancoDeAula)
                        <tr data-entry-id="{{ $bancoDeAula->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Titulo:</strong> {{ $bancoDeAula->titulo ?? '' }} </p>
                                <p> <strong>Autor:</strong> {{ $bancoDeAula->autor ?? '' }} </p>
                                <p> <strong>Publico Alvo:</strong> {{ App\Models\BancoDeAula::PUBLICO_ALVO_SELECT[$bancoDeAula->publico_alvo] ?? '' }} </p>
                                <p> <strong>Área de conhecimento:</strong> @foreach($bancoDeAula->area_de_conhecimentos as $key => $item) <span class="badge badge-info">{{ $item->nome_da_materia }}</span> @endforeach </p>
                                <p> <strong>Situação:</strong> {{ App\Models\BancoDeAula::SITUACAO_DO_PROJETO_SELECT[$bancoDeAula->situacao_do_projeto] ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $bancoDeAula->created_at ?? '' }} por {{ $bancoDeAula->assinatura->name ?? '' }} de {{ $bancoDeAula->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $bancoDeAula->titulo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeAula->autor ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\BancoDeAula::PUBLICO_ALVO_SELECT[$bancoDeAula->publico_alvo] ?? '' }}
                            </td>
                            <td class="invisib">
                              @foreach($bancoDeAula->area_de_conhecimentos as $key => $item) <span class="badge badge-info">{{ $item->nome_da_materia }}</span> @endforeach
                            </td>
                            <td class="invisib">
                              {{ App\Models\BancoDeAula::SITUACAO_DO_PROJETO_SELECT[$bancoDeAula->situacao_do_projeto] ?? '' }}
                              </td>
                            <td class="invisib">
                                {{ $bancoDeAula->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeAula->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $bancoDeAula->created_at ?? '' }}
                            </td>
                                  <td class="btnn">
                                   <div class="header">
                                   <div class="dropdown">
                                     <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $bancoDeAula->id }}()"> <li></li> <li></li> <li></li> </ul>
                                     <div id="myDropdown{{ $bancoDeAula->id }}" class="dropdown-content">
                                    @can('banco_de_aula_show') <a href="{{ route('admin.banco-de-aulas.show', $bancoDeAula->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                    @can('banco_de_aula_edit') <a href="{{ route('admin.banco-de-aulas.edit', $bancoDeAula->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                    @can('banco_de_aula_delete') <form id="delete-{{ $bancoDeAula->id }}" action="{{ route('admin.banco-de-aulas.destroy', $bancoDeAula->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                    <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $bancoDeAula->id }}').submit()">
                                    <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                                    @can('change_bancos') <button class="btn-submit" onclick="window.open('{{ route('admin.aulas.propostas.atualizar') }}?id={{$bancoDeAula->id}}','MyWindow','width=600,height=300,toolbar=no,menubar=no,location=no,status=no,scrollbars=no,resizable=no,left=383,top=234');return false;"
                                    type="submit"> <i class="fas fa-sync-alt"></i> Atualizar Proposta @endcan
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

                                  function showDropdown{{ $bancoDeAula->id }}() {
                                  document.getElementById("myDropdown{{ $bancoDeAula->id }}").classList.toggle("dshow");
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
                            <link rel="stylesheet" href="{{ url('resources/banco-de-aulas.css') }}">

                            <style media="screen">

                            @media (min-width: 1024px) and (max-width: 1024px) {
                            .container-fluid[data-ativo='close'] {
                                width: 95% !important;
                                margin-right: auto;
                                margin-left: 0 !important;
                                margin-top: 9rem;
                                transition: all 0.5s ease;
                              }

                              .container-fluid[data-ativo='open'] {
                                  width: 80% !important;
                                  margin-right: auto;
                                  margin-left: -15px !important;
                                  margin-top: 9rem;
                                  transition: all 0.5s ease;
                              }
                            }
                            
                            </style>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('banco_de_aula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banco-de-aulas.massDestroy') }}",
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
  let table = $('.datatable-BancoDeAula:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
