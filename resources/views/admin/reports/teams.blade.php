@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Instituições
    </div>
    </div>

    <form method="GET" action="{{ route("admin.reports.teams") }}">

    <div class="card-select">

    <div class="selecionar">
    <div class="span"> <span> Tipo de Instituição </span> </div>

     <select name="type" id="type">
     <option value="all"> Todas </option>
     @foreach($types as $type)
     <option value="{{ $type->id }}" {{ (old('escola') ? old('escola') : $type->id ?? '') == $request_type ? 'selected' : '' }}> {{ $type->titulo }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Localização </span> </div>

     <select name="localizacao" id="localizacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Team::LOCALIZACAO_RADIO as $key => $item)
          <option value="{{ $item }}" {{ old('localizacao', $item) === (string) $request_localizacao ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Estado </span> </div>

     <select name="estado" id="estado">
     <option value="all"> Todos </option>
     @foreach(App\Models\Team::ESTADO_SELECT as $key => $label)
         <option value="{{ $key }}" {{ old('estado', $key) === (string) $request_estado ? 'selected' : '' }}>{{ $label }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Situação </span> </div>

     <select name="situacao" id="situacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Team::SITUACAO_SELECT as $key => $item)
          <option value="{{ $item }}" {{ old('situacao', $item) === (string) $request_situacao ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Administração </span> </div>

     <select name="administracao" id="administracao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT as $key => $item)
          <option value="{{ $item }}" {{ old('administracao', $item) === (string) $request_administracao ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
     </select>

    </div>

    <div class="send">
        <input type="submit" value="➞">  </input>
    </div>

    </div>

    </form>

    <?php

    $query = ''; $where = [];

    if($request_type != 'all'){ $where[] = "where('tipo_de_instituicao_id', ". $request_type . ")->"; }
    if($request_localizacao != 'all'){ $where[] = "where('localizacao', ". '$request_localizacao' . ")->"; }
    if($request_estado != 'all'){ $where[] = "where('estado', ". '$request_estado' . ")->"; }
    if($request_situacao != 'all'){ $where[] = "where('situacao', ". '$request_situacao' . ")->"; }
    if($request_administracao != 'all'){ $where[] = "where('dependencia_administrativa', ". '$request_administracao' . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("use App\Models\Team;" . "$" . "escolas = " . "Team::". $query. "get();");

    $escolas_p = (count($escolas)* 100)/count($teams);
    $round_escolas = round($escolas_p, 2);
    $prctg_escolas = str_replace(",",".", $round_escolas);

    $total = count($teams) ." instituições no total";
    $filtro = count($escolas) ." instituições filtradas";

    ?>

<table id="example" class="table table-bordered table-striped table-hover datatable datatable-user">
  <thead>
    <tr>
      <th class="noExport"> </th>
      <th class="noSorting"> </th>
      <th style="width: 50%;" aria-sort="none"> Nome </th>
      <th style="width: 50%;" aria-sort="none"> Tipo </th>
      <th style="width: 50%;" aria-sort="none"> Localização </th>
      <th style="width: 50%;" aria-sort="none"> Estado </th>
      <th style="width: 50%;" aria-sort="none"> Cidade </th>
      <th style="width: 50%;" aria-sort="none"> Situação </th>
      <th style="width: 50%;" aria-sort="none"> Administração </th>
      <th> </th>
    </tr>
    <tbody>
      @foreach($escolas as $team)
          <td> </td>
          <td> </td>
          <td>
             {{ $team->name }}
          </td>
          <td>
             {{ $team->tipo_de_instituicao->titulo }}
          </td>
          <td>
             {{ $team->localizacao }}
          </td>
          <td>
             {{ App\Models\Team::ESTADO_SELECT[$team->estado] ?? '' }}
          </td>
          <td>
             {{ $team->cidade }}
          </td>
          <td>
             {{ $team->situacao }}
          </td>
          <td>
             {{ $team->dependencia_administrativa }}
          </td>
          <td> </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="chart"> </div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<link rel="stylesheet" href="{{ url('reports/teams.css') }}">

      @endsection
      @section('scripts')
      @parent

      <script>
          $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-user:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
                color: '#ff7f50',
                data: [100, {{ $prctg_escolas }}]
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

             var chart = new ApexCharts(document.querySelector("#chart"), options);
             chart.render();


      </script>

      @endsection
