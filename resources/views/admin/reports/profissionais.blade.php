@extends('layouts.admin')
@section('content')

<!-- profissionais -->

<div class="card">
    <div class="card-header">
        Relatórios de Profissionais
    </div>
    </div>

    <form method="GET" action="{{ route("admin.reports.profissionais") }}">

    <div class="card-select">

    <div class="selecionar">
    <div class="span"> <span> Genero </span> </div>

     <select name="genero" id="genero">
     <option value="all"> Todos </option>
     @foreach(App\Models\Profissionai::GENERO_RADIO as $key => $item)
     <option value="{{ $key }}" {{ (old('genero') ? old('genero') : $key ?? '') == $request_genero ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Localização </span> </div>

     <select name="localizacao" id="localizacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Profissionai::LOCALIZACAO_RADIO as $key => $item)
         <option value="{{ $key }}" {{ (old('localizacao') ? old('localizacao') : $key ?? '') == $request_localizacao ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Estado </span> </div>

     <select name="estado" id="estado">
     <option value="all"> Todos </option>
     @foreach(App\Models\Profissionai::ESTADO_SELECT as $key => $item)
         <option value="{{ $key }}" {{ (old('estado') ? old('estado') : $key ?? '') == $request_estado ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Situação </span> </div>

     <select name="situacao" id="situacao">
     <option value="all"> Todos </option>
     @foreach(App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT as $key => $item)
         <option value="{{ $key }}" {{ (old('situacao') ? old('situacao') : $key ?? '') == $request_situacao ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Função </span> </div>

     <select name="funcao" id="funcao">
     <option value="all"> Todos </option>
     @foreach($types as $type)
         <option value="{{ $type->id }}" {{ (old('funcao') ? old('funcao') : $type->id ?? '') == $request_funcao ? 'selected' : '' }}>{{ $type->titulo }}</option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Instituição </span> </div>

     <select name="instituicao" id="instituicao">
     <option value="all"> Todos </option>
     @foreach($teams as $team)
          <option value="{{ $team->id }}" {{ old('instituicao', $team->id) == $request_instituicao ? 'selected' : '' }}>{{ $team->name }}</option>
      @endforeach
     </select>

    </div>

    <div class="send">
        <input type="submit" value="➞">  </input>
    </div>

    </div>

    </form>

    <?php


    use Illuminate\Support\Arr;

    $request_f = DB::table('profissionai_tipo_de_profissional')->where('tipo_de_profissional_id', $request_funcao)->pluck('profissionai_id')->toArray();
    $array_f = implode(",", $request_f);

    $query = ''; $where = [];

    if($request_funcao != 'all'){ $where[] = "whereIn('id', array($array_f))->"; }
    if($request_genero != 'all'){ $where[] = "where('genero', ". '$request_genero' . ")->"; }
    if($request_localizacao != 'all'){ $where[] = "where('localizacao', ". '$request_localizacao' . ")->"; }
    if($request_estado != 'all'){ $where[] = "where('estado', ". '$request_estado' . ")->"; }
    if($request_situacao != 'all'){ $where[] = "where('situacao_de_contratacao', ". '$request_situacao' . ")->"; }
    if($request_instituicao != 'all'){ $where[] = "where('instituicao_id', ". $request_instituicao . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("use App\Models\Profissionai;" . "$" . "profissionais_filtro = " . "Profissionai::". $query. "get();");

    $profissional_p = (count($profissionais_filtro)* 100)/count($profissionais);
    $round_profissional = round($profissional_p, 2);
    $prctg_profissional = str_replace(",",".", $round_profissional);

    $total = count($profissionais) ." Profissionais no total";
    $filtro = count($profissionais_filtro) ." Profissionais filtrados";

    ?>

    <div class="table-div">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-profissional">
        <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Nome </th>
            <th style="width: 50%;" aria-sort="none"> Genero </th>
            <th style="width: 50%;" aria-sort="none"> Localização </th>
            <th style="width: 50%;" aria-sort="none"> Estado </th>
            <th style="width: 50%;" aria-sort="none"> Cidade </th>
            <th style="width: 50%;" aria-sort="none"> Situação </th>
            <th style="width: 50%;" aria-sort="none"> Função </th>
            <th style="width: 50%;" aria-sort="none"> Instituições </th>
            <th> </th>
          </tr>
          <tbody>
            @foreach($profissionais_filtro as $profissional)
                <td> </td>
                <td> </td>
                <td>
                   {{ $profissional->nome_completo }}
                </td>
                <td>
                   {{ App\Models\Profissionai::GENERO_RADIO[$profissional->genero] ?? '' }}
                </td>
                <td>
                    {{ $profissional->localizacao }}
                </td>
                <td>
                   {{ App\Models\Profissionai::ESTADO_SELECT[$profissional->estado] ?? '' }}
                </td>
                <td>
                   {{ $profissional->cidade }}
                </td>
                <td>
                   {{ $profissional->situacao_de_contratacao }}
                </td>
                <td>
                   @foreach($profissional->funcaos as $key => $item) {{ $item->titulo }} @endforeach
                </td>
                <td>
                   {{ $profissional->instituicao->name }}
                </td>
                <td>

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>

    <div id="chart"> </div>

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

            <!-- profissional -->

            <script>
                $(function () {
              let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

              $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 2, 'desc' ]],
                pageLength: 5,
              });
              let table = $('.datatable-profissional:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
                      color: '#62f191',
                      data: [100, {{ $prctg_profissional }}]
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
