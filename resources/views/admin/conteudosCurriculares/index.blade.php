@extends('layouts.admin')
@section('content')

@can('conteudos_curriculare_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.conteudos-curriculares.create') }}">
                Cadastrar Conteudo Curricular
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
      Registros de Conteudos Curriculares
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-ConteudosCurriculare">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>
                       <th>
                          Base Curricular
                       </th>
                       <th>
                           Codigo
                       </th>
                       <th>
                           Nivel de Ensino
                       </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.disciplina') }}
                        </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.bimestres') }}
                        </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.campo_eixo') }}
                        </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.recurso_didatico') }}
                        </th>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.situacao_didatica') }}
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
                        <td> <p class="fil"> Base Curricular </p>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              <option value="BNCC"> BNCC </option>
                              <option value="CDP"> Currículo de Pernambuco </option>
                          </select>
                        </td>
                        <td class="d"></td>
                        <td> <p class="fil"> Nivel de Ensino </p>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              <option value="Ensino Infantil"> Ensino Infantil </option>
                              <option value="Ensino Fundamental 1"> Ensino Fundamental 1 </option>
                              <option value="Ensino Fundamental 2"> Ensino Fundamental 2 </option>
                              <option value="EJA"> EJA </option>
                          </select>
                        </td>
                        <td> <p class="fil">Serie</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Creche I"> Creche I</option>
                                <option value="Creche II"> Creche II</option>
                                <option value="Pré-escolar"> Pré-escolar</option>
                                <option value="1º ano"> 1º ano </option>
                                <option value="2º ano"> 2º ano</option>
                                <option value="3º ano"> 3º ano</option>
                                <option value="4º ano"> 4º ano</option>
                                <option value="5º ano"> 5º ano</option>
                                <option value="6º ano"> 6º ano</option>
                                <option value="7º ano"> 7º ano</option>
                                <option value="8º ano"> 8º ano</option>
                                <option value="9º ano"> 9º ano</option>
                                <option value="1º ano(EJA)"> 1º ano - EJA </option>
                                <option value="2º ano(EJA)"> 2º ano - EJA </option>
                                <option value="3º ano(EJA)"> 3º ano - EJA </option>
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
                        <td> <p class="fil">Bimestre</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\ConteudosCurriculare::BIMESTRES_SELECT as $key => $item)
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
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conteudosCurriculares as $key => $conteudosCurriculare)
                        <tr data-entry-id="{{ $conteudosCurriculare->id }}">
                            <td>

                            </td>
                            <td>
                              <p> <strong>Base Curricular: </strong> {{ $conteudosCurriculare->bncc_x_cdp ?? 'Não atribuido' }} </p>
                              <p> <strong>Codigo:</strong> @if($conteudosCurriculare->bncc_x_cdp == 'BNCC') {{ $conteudosCurriculare->bncc->codigo ?? 'Não atribuido' }} @else {{ $conteudosCurriculare->cdp->codigo ?? 'Não atribuido' }} @endif </p>
                              <p> <strong>Nivel de Ensino:</strong> {{ $conteudosCurriculare->nivel_de_ensino ?? 'Não atribuido' }} </p>
                              <p> <strong>Turmas:</strong> @foreach($series as $s) @if($s->conteudos_curriculare_id == $conteudosCurriculare->id) <span class="badge badge-info">{{ $s->serie }}</span> @endif @endforeach </p>
                              @if($conteudosCurriculare->nivel_de_ensino == 'Ensino Infantil') @else <p> <strong>Disciplina:</strong> {{ $conteudosCurriculare->disciplina->nome_da_materia ?? 'Não atribuido' }} </p> @endif
                              <p> <strong>Bimestre:</strong> {{ App\Models\ConteudosCurriculare::BIMESTRES_SELECT[$conteudosCurriculare->bimestres] ?? 'Não atribuido' }} </p>
                              <p> <strong>Campo/Eixo:</strong> {{ App\Models\ConteudosCurriculare::CAMPO_EIXO_SELECT[$conteudosCurriculare->campo_eixo] ?? 'Não atribuido' }} </p>
                              <p> <strong>Recurso Didático:</strong> {{ App\Models\ConteudosCurriculare::RECURSO_DIDATICO_SELECT[$conteudosCurriculare->recurso_didatico] ?? 'Não atribuido' }} </p>
                              <p> <strong>Siuação Didática:</strong> {{ App\Models\ConteudosCurriculare::SITUACAO_DIDATICA_SELECT[$conteudosCurriculare->situacao_didatica] ?? 'Não atribuido' }} </p>
                                <p class="cad">
                                cadastrado em {{ $conteudosCurriculare->created_at ?? '' }} por {{ $conteudosCurriculare->assinatura->name ?? 'Autor' }} de {{ $conteudosCurriculare->team->name ?? 'Instituição' }}
                                </p>
                            </td>
                            <td class="invisib">
                              {{ $conteudosCurriculare->bncc_x_cdp ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                              @if($conteudosCurriculare->bncc_x_cdp == 'BNCC') {{ $conteudosCurriculare->bncc->codigo ?? 'Não atribuido' }} @else {{ $conteudosCurriculare->cdp->codigo ?? 'Não atribuido' }} @endif
                            </td>
                            <td class="invisib">
                              {{ $conteudosCurriculare->nivel_de_ensino ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                               @foreach($series as $s) @if($s->conteudos_curriculare_id == $conteudosCurriculare->id) <span class="badge badge-info">{{ $s->serie }}</span> @endif @endforeach
                            </td>
                            <td class="invisib">
                                {{ $conteudosCurriculare->disciplina->nome_da_materia ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\ConteudosCurriculare::BIMESTRES_SELECT[$conteudosCurriculare->bimestres] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\ConteudosCurriculare::CAMPO_EIXO_SELECT[$conteudosCurriculare->campo_eixo] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\ConteudosCurriculare::RECURSO_DIDATICO_SELECT[$conteudosCurriculare->recurso_didatico] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\ConteudosCurriculare::SITUACAO_DIDATICA_SELECT[$conteudosCurriculare->situacao_didatica] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $conteudosCurriculare->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $conteudosCurriculare->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $conteudosCurriculare->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $conteudosCurriculare->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $conteudosCurriculare->id }}" class="dropdown-content">
                                   @can('conteudos_curriculare_show') <a href="{{ route('admin.conteudos-curriculares.show', $conteudosCurriculare->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('conteudos_curriculare_edit') <a href="{{ route('admin.conteudos-curriculares.edit', $conteudosCurriculare->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('conteudos_curriculare_delete') <form id="delete-{{ $conteudosCurriculare->id }}" action="{{ route('admin.conteudos-curriculares.destroy', $conteudosCurriculare->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $conteudosCurriculare->id }}').submit()">
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

                                function showDropdown{{ $conteudosCurriculare->id }}() {
                                document.getElementById("myDropdown{{ $conteudosCurriculare->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/conteudos-curriculares.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('conteudos_curriculare_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.conteudos-curriculares.massDestroy') }}",
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
    order: [[ 7, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-ConteudosCurriculare:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
