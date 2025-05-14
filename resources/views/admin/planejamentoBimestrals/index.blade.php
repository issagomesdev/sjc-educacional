@extends('layouts.admin')
@section('content')

@can('planejamento_bimestral_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.planejamento-bimestrals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.planejamentoBimestral.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.planejamentoBimestral.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable datatable-PlanejamentoBimestral">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                      <th>
                          Aula N°
                      </th>
                      <th>
                          Status
                      </th>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.disciplina') }}
                        </th>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.turma') }}
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
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Status</p>
                          <select class="search" strict="true">
                                  <option value>{{ trans('global.all') }}</option>
                                  @foreach(App\Models\PlanejamentoBimestral::STATUS_RADIO as $key => $item)
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
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Turma</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($turmas as $key => $item)
                                    <option value="{{ $item->ano_serie }}">{{ $item->ano_serie }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Situação</p>
                          <select class="search" strict="true">
                                  <option value>{{ trans('global.all') }}</option>
                                  <option value="Pendente"> Pendente </option>
                                  @foreach(App\Models\PlanejamentoBimestral::APROVAR_DESAPROVAR as $key => $item)
                                      <option value="{{ $item }}">{{ $item }}</option>
                                  @endforeach
                              </select>
                            </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>


                    </tr>
                </thead>
                <tbody>
                    @foreach($planejamentoBimestrals as $key => $planejamentoBimestral)
                        <tr data-entry-id="{{ $planejamentoBimestral->id }}">
                            <td> </td>
                            <td class="ok">

                             <!-- {{ App\Models\PlanejamentoBimestral::STATUS_RADIO[$planejamentoBimestral->aulas_dadas] ?? '' }} -->

                          @if($planejamentoBimestral->aulas_dadas == 1)
                              <form method="POST" action="{{ route("admin.planejamento-bimestrals.update", [$planejamentoBimestral->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <input class="form-check-input" type="hidden" id="aulas_dadas" name="aulas_dadas" value="2">
                                <div class="form-group">
                                    <button data-tooltip="Aula Prevista" data-flow="bottom" class="btn btn-for" type="submit">
                                        ✘
                                    </button>
                                </div>

                                </form>
                                @endif

                           @if($planejamentoBimestral->aulas_dadas == 2)
                                <form method="POST" action="{{ route("admin.planejamento-bimestrals.update", [$planejamentoBimestral->id]) }}" enctype="multipart/form-data">
                                  @method('PUT')
                                  @csrf

                                  <input class="form-check-input" type="hidden" id="aulas_dadas" name="aulas_dadas" value="1">
                                  <div class="form-group">
                                      <button data-tooltip="Aula dada" data-flow="bottom" class="btn btn-check" type="submit">
                                          ✓
                                      </button>
                                  </div>

                                  </form>
                                  @endif


                              <p> <strong>Aula N°:</strong> {{ $planejamentoBimestral->aula_n ?? 'Não atribuido' }} </p>
                              <p> <strong>Disciplina:</strong> {{ $planejamentoBimestral->disciplina->nome_da_materia ?? 'Não atribuido' }} </p>
                              <p> <strong>Escola:</strong> {{ $planejamentoBimestral->escola->name ?? 'Não atribuido' }} </p>
                              <p> <strong>Turma:</strong> {{ $planejamentoBimestral->turma->ano_serie ?? 'Não atribuido' }} - @if($planejamentoBimestral->turma) {{ $planejamentoBimestral->turma::NIVEL_DA_TURMA_RADIO[$planejamentoBimestral->turma->nivel_da_turma] ?? '' }} @endif </p>
                              <p> <strong>Situação:</strong> {{ App\Models\PlanejamentoBimestral::APROVAR_DESAPROVAR[$planejamentoBimestral->situacao] ?? 'Pendente' }} </p>
                                <p class="cad">
                                cadastrado em {{ $planejamentoBimestral->created_at ?? '' }} por {{ $planejamentoBimestral->assinatura->name ?? 'Autor' }} de {{ $planejamentoBimestral->team->name ?? 'Instituição' }}
                                </p>

                            </td>
                            <td class="invisib">
                              {{ $planejamentoBimestral->aula_n; }}
                            </td>
                            <td class="invisib">
                              {{ App\Models\PlanejamentoBimestral::STATUS_RADIO[$planejamentoBimestral->aulas_dadas] ?? 'Aula prevista' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->disciplina->nome_da_materia ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->escola->name ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->turma->ano_serie ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\PlanejamentoBimestral::APROVAR_DESAPROVAR[$planejamentoBimestral->situacao] ?? 'Pendente' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $planejamentoBimestral->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $planejamentoBimestral->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $planejamentoBimestral->id }}" class="dropdown-content">
                                  @can('planejamento_bimestral_show') <a href="{{ route('admin.planejamento-bimestrals.show', $planejamentoBimestral->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                  @can('planejamento_bimestral_edit') <a href="{{ route('admin.planejamento-bimestrals.edit', $planejamentoBimestral->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                  @can('planejamento_bimestral_delete') <form id="delete-{{ $planejamentoBimestral->id }}" action="{{ route('admin.planejamento-bimestrals.destroy', $planejamentoBimestral->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                  <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $planejamentoBimestral->id }}').submit()">
                                  <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                                  @can('aprovar_planejamento') <button class="btn-submit" onclick="window.open('{{ route('admin.planejamento-bimestrals.atualizar') }}?id={{$planejamentoBimestral->id}}','MyWindow','width=600,height=300,toolbar=no,menubar=no,location=no,status=no,scrollbars=no,resizable=no,left=383,top=234');return false;"
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

                                function showDropdown{{ $planejamentoBimestral->id }}() {
                                document.getElementById("myDropdown{{ $planejamentoBimestral->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/planejamento-bimestrals.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('planejamento_bimestral_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.planejamento-bimestrals.massDestroy') }}",
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
    order: [[ 11, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-PlanejamentoBimestral:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
