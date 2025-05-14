@extends('layouts.admin')

<head>
    <title> Relatórios de Estudantes </title>
</head>

@section('content')

<!-- Estudantes -->

<div class="card">
    <div class="card-header">
        Relatórios de Estudantes
    </div>
    </div>

    <form method="GET" action="{{ route("admin.reports.estudantes") }}">

    <div class="card-select">

    <div class="selecionar">
    <div class="span"> <span> Escola </span> </div>
    <select name="escola" id="escola">
    <option value="all"> Todos </option>
     @foreach($teams as $team)
     <option value="{{ $team->id }}" {{ old('escola', $team->id) == $request_escola ? 'selected' : '' }}>{{ $team->name }}</option>
     @endforeach
     </select>
     </div>

     <div class="selecionar">
     <div class="span"> <span> Serie </span> </div>
     <select name="serie" id="serie">
     <option value="all"> Todos </option>
      @foreach(App\Models\Turma::SERIES as $key => $item)
       <option value="{{ $key }}" {{ (old('serie') ? old('serie') : $key ?? '') == $request_serie ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
      </select>
      </div>

    <div class="selecionar">
    <div class="span"> <span> Genero </span> </div>
     <select name="genero" id="genero">
     <option value="all"> Todos </option>
     @foreach(App\Models\Cadastro::GENERO_RADIO as $key => $item)
     <option value="{{ $key }}" {{ (old('genero') ? old('genero') : $key ?? '') == $request_genero ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>
     </div>

    <div class="selecionar">
    <div class="span"> <span> Situação </span> </div>
     <select name="situacao" id="situacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Cadastro::SITUACAO_ALUNO as $key => $item)
     <option value="{{ $key }}" {{ (old('situacao') ? old('situacao') : $key ?? '') == $request_situacao ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>
     </div>

    <div class="selecionar">
    <div class="span"> <span> Localização </span> </div>

     <select name="localizacao" id="localizacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Cadastro::LOCALIZACAO_RADIO as $key => $item)
         <option value="{{ $key }}" {{ (old('localizacao') ? old('localizacao') : $key ?? '') == $request_localizacao ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Estado </span> </div>

     <select name="estado" id="estado">
     <option value="all"> Todos </option>
     @foreach(App\Models\Cadastro::ESTADO_SELECT as $key => $item)
         <option value="{{ $key }}" {{ (old('estado') ? old('estado') : $key ?? '') == $request_estado ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>
    </div>

    <div class="send">
        <input type="submit" value="➞">  </input>
    </div>
    </div>

    </form>

    <?php

    use App\Models\Turma;

    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();

    $query = ''; $where = [];

    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_serie != 'all'){ $where[] = "whereIn('turma_id', ". '$request_s' . ")->"; }
    if($request_genero != 'all'){ $where[] = "where('genero', ". '$request_genero' . ")->"; }
    if($request_situacao != 'all'){ $where[] = "where('situacao', ". '$request_situacao' . ")->"; }
    if($request_localizacao != 'all'){ $where[] = "where('localizacao', ". '$request_localizacao' . ")->"; }
    if($request_estado != 'all'){ $where[] = "where('estado', ". '$request_estado' . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("use App\Models\Cadastro;" . "$" . "estudantes = " . "Cadastro::". $query. "get();");

    $estudantes_p = (count($estudantes)* 100)/count($cadastros);
    $round_estudantes = round($estudantes_p, 2);
    $prctg_estudantes = str_replace(",",".", $round_estudantes);

    $total = count($cadastros) ." Estudantes no total";
    $filtro = count($estudantes) ." Estudantes filtrados";

    ?>

    <div class="table-div">
          <table id="example" class="table table-bordered table-striped table-hover datatable datatable-estudantes">
          <thead>
              <tr>
                <th class="noExport"> </th>
                <th class="noSorting"> </th>
                <th style="width: 50%;" aria-sort="none"> Nome do Aluno </th>
                <th style="width: 50%;" aria-sort="none"> Escola </th>
                <th style="width: 50%;" aria-sort="none"> Serie </th>
                <th style="width: 50%;" aria-sort="none"> Genero </th>
                <th style="width: 50%;" aria-sort="none"> Idade </th>
                <th style="width: 50%;" aria-sort="none"> Situação </th>
                <th style="width: 50%;" aria-sort="none"> Localização </th>
                <th style="width: 50%;" aria-sort="none"> Estado </th>
                <th> </th>
            <tbody>
              @foreach($estudantes as $key => $cadastro)
                  <tr data-entry-id="{{ $cadastro->id }}">
                      <td> </td>
                      <td></td>
                      <td>
                          {{ $cadastro->nome_completo ?? 'Não atribuido' }}
                      </td>
                      <td>
                          {{ $cadastro->escola->name ?? 'Não atribuido' }}
                      </td>
                      <td>
                          {{ $cadastro->turma->serie ?? 'Não atribuido' }}
                      </td>
                      <td>
                          {{ $cadastro->genero ?? 'Não atribuido' }}
                      </td>
                      <td>
                        <?php
                        $bd = "{$cadastro->data_de_nascimento}/{$cadastro->ano_de_nascimento}";
                        $data = $bd;
                        list($dia, $mes, $ano) = explode('/', $data);
                        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                        $resultado_idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                        if ($resultado_idade <= 9) { $idade = '0' . $resultado_idade; } else { $idade = $resultado_idade; }
                        echo $idade . ' anos'; ?>
                      </td>
                      <td>
                        {{ App\Models\Cadastro::SITUACAO_ALUNO[$cadastro->situacao] ?? 'Não atribuido' }}
                      </td>
                      <td>
                        {{ App\Models\Cadastro::LOCALIZACAO_RADIO[$cadastro->localizacao] ?? 'Não atribuido' }}
                      </td>
                      <td>
                          {{ App\Models\Cadastro::ESTADO_SELECT[$cadastro->estado] ?? 'Não atribuido' }}
                      </td>
                      <td> </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>

    <div id="chart-estudantes"> </div>

    <!-- Enturmação -->

<div class="card">
    <div class="card-header">
        Relatórios de Enturmação
    </div>
    </div>

    <div class="grapic">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-enturm">
      <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Ano </th>
            <th style="width: 50%;" aria-sort="none"> Escola </th>
            <th style="width: 50%;" aria-sort="none"> Serie </th>
            <th style="width: 50%;" aria-sort="none"> Aluno </th>
            <th> </th>
          </tr>
          <tr>
            <td class="select"></td>
            <td> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td>
              <select class="search">
                  <option value>{{ trans('global.all') }}</option>
                  <option value="Não atribuido">Não atribuido</option>
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
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
            <td> </td>
          </tr>
        <tbody>
          @foreach($enturmacao as $entur)
              <tr data-entry-id="{{ $entur->id }}">
                  <td> </td>
                  <td> </td>
                  <td>
                      {{ $entur->ano }}
                  </td>
                  <td>
                      {{ $entur->escola->name }}
                  </td>
                  <td>
                      {{ $entur->turma->serie }}
                  </td>
                  <td>
                    {{ $entur->aluno->nome_completo }}
                  </td>
                  <td> </td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>

<!-- Transferências Realizadas -->

<div class="card">
    <div class="card-header">
        Relatórios de Transferências Realizadas
    </div>
    </div>

    <div class="grapic">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-transf">
      <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Ano </th>
            <th style="width: 50%;" aria-sort="none"> Tipo de Transferência </th>
            <th style="width: 50%;" aria-sort="none"> Escola </th>
            <th style="width: 50%;" aria-sort="none"> Serie </th>
            <th style="width: 50%;" aria-sort="none"> Aluno </th>
            <th> </th>
          </tr>
          <tr>
            <td class="select"></td>
            <td> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td> <select class="search" strict="true">
                <option value>{{ trans('global.all') }}</option>
                @foreach(App\Models\Transferencium::TIPO_DE_TRANSFERENCIA as $key => $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
               </select> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td>
              <select class="search">
                  <option value>{{ trans('global.all') }}</option>
                  <option value="Não atribuido">Não atribuido</option>
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
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
            <td> </td>
          </tr>
        <tbody>
          @foreach($transferencia as $transf)
              <tr data-entry-id="{{ $transf->id }}">
                  <td> </td>
                  <td> </td>
                  <td>
                      {{ $transf->ano }}
                  </td>
                  <td>
                      {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transf->tipo_de_transferencia] }}
                  </td>
                  <td>
                      {{ $transf->escola->name }}
                  </td>
                  <td>
                      {{ $transf->turma->serie }}
                  </td>
                  <td>
                    {{ $transf->aluno->nome_completo }}
                  </td>
                  <td> </td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>

<!-- Transferências Recebidas -->

<div class="card">
    <div class="card-header">
        Relatórios de Transferências Recebidas
    </div>
    </div>

    <div class="grapic">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-transf-rec">
      <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Ano </th>
            <th style="width: 50%;" aria-sort="none"> Tipo de Transferência </th>
            <th style="width: 50%;" aria-sort="none"> Escola </th>
            <th style="width: 50%;" aria-sort="none"> Serie </th>
            <th style="width: 50%;" aria-sort="none"> Aluno </th>
            <th> </th>
          </tr>
          <tr>
            <td class="select"></td>
            <td> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td> <select class="search" strict="true">
                <option value>{{ trans('global.all') }}</option>
                @foreach(App\Models\Transferencium::TIPO_DE_TRANSFERENCIA as $key => $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
               </select> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td>
              <select class="search">
                  <option value>{{ trans('global.all') }}</option>
                  <option value="Não atribuido">Não atribuido</option>
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
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"> </td>
            <td> </td>
          </tr>
        <tbody>
          @foreach($transferencias_recebidas as $transf)
              <tr data-entry-id="{{ $transf->id }}">
                  <td> </td>
                  <td> </td>
                  <td>
                      {{ $transf->ano }}
                  </td>
                  <td>
                      {{ App\Models\TransferenciasRecebidas::TIPO_DE_TRANSFERENCIA[$transf->tipo_de_transferencia] }}
                  </td>
                  <td>
                      {{ $transf->old_escola->name }}
                  </td>
                  <td>
                      {{ $transf->old_turma->serie }}
                  </td>
                  <td>
                    {{ $transf->aluno->nome_completo }}
                  </td>
                  <td> </td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>

<!-- Rematriculas -->

<div class="card">
    <div class="card-header">
        Relatórios de Rematriculas
    </div>
    </div>

    <div class="grapic">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-rematr">
      <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Ano </th>
            <th style="width: 50%;" aria-sort="none"> Escola </th>
            <th style="width: 50%;" aria-sort="none"> Serie </th>
            <th style="width: 50%;" aria-sort="none"> Serie destino </th>
            <th> </th>
          </tr>
          <tr>
            <td class="select"></td>
            <td> </td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td> <input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
            <td>
              <select class="search">
                  <option value>{{ trans('global.all') }}</option>
                  <option value="Não atribuido">Não atribuido</option>
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
            <td>
              <select class="search">
                  <option value>{{ trans('global.all') }}</option>
                  <option value="Não atribuido">Não atribuido</option>
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
            <td> </td>
          </tr>
        <tbody>
          @foreach($rematriculas as $rematricula)
              <tr data-entry-id="{{ $transf->id }}">
                  <td> </td>
                  <td> </td>
                  <td>
                      {{ $rematricula->ano }}
                  </td>
                  <td>
                      {{ $rematricula->escola->name }}
                  </td>
                  <td>
                      {{ $rematricula->turma->serie }}
                  </td>
                  <td>
                    {{ $rematricula->turma_nova->serie }}
                  </td>
                  <td> </td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="{{ url('reports/teams.css') }}">

<style media="screen">

.send {
    margin-left: 10px;
}

</style>


      @endsection
      @section('scripts')
      @parent

      <!-- estudantes -->

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-estudantes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

      <script>

      var options = {
               series: [{
                name: 'Porcentagem',
                color: '#ef5160',
                data: [100, {{ $prctg_estudantes }}]
             }],
               chart: {
               type: 'bar',
               background: '#fff',
               height: 500
             },
             plotOptions: {
               bar: {
                 horizontal: false,
                 columnWidth: '30px',
                 endingShape: 'rounded'
               },
             },
             dataLabels: {
               enabled: true
             },
             stroke: {
               show: true,
               width: 2,
               colors: ['transparent']
             },
             xaxis: {
               categories: ['{{ $total }}', '{{ $filtro }}'],
             },
             yaxis: {
               title: {
                 text: ''
               }
             },
             fill: {
               opacity: 1
             },
             tooltip: {
               y: {
                 formatter: function (val) {
                   return "" + val + "%"
                 }
               }
             }
             };

             var chart = new ApexCharts(document.querySelector("#chart-estudantes"), options);
             chart.render();

      </script>

      <!-- enturmação -->

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-enturm:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

      <!-- transf -->

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-transf:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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


      <!-- transf rec -->

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-transf-rec:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

      <!-- rematriculas -->

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-rematr:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
