@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Desempenho Escolar
    </div>
    </div>

    <form method="GET" action="{{ route("admin.reports.desempenho") }}">

    <div class="card-select">

    <div class="selecionar">
    <div class="span"> <span> Escola </span> </div>

     <select name="escola" id="escola">
     <option value="all"> Todas </option>
     @foreach($escolas as $escola)
     <option value="{{ $escola->id }}" {{ (old('escola') ? old('escola') : $escola->id ?? '') == $request_escola ? 'selected' : '' }}> {{ $escola->name }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Ano </span> </div>

     <select name="ano" id="ano">
     <option value="all"> Todos </option>
     @foreach($anos as $ano)
     <option value="{{ $ano->id }}" {{ (old('ano') ? old('ano') : $ano->id ?? '') == $request_ano ? 'selected' : '' }}> {{ $ano->ano }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Turno </span> </div>

     <select name="turno" id="turno">
     <option value="all"> Todos </option>
     @foreach(App\Models\Turma::TURNO_RADIO as $key => $item)
     <option value="{{ $item }}" {{ (old('turno') ? old('turno') : $item ?? '') == $request_turno ? 'selected' : '' }}> {{ $item }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Nivel </span> </div>

     <select name="nivel" id="nivel">
     <option value="all"> Todos </option>
     @foreach(App\Models\Turma::NIVEL_DA_TURMA_RADIO as $key => $item)
     <option value="{{ $item }}" {{ (old('nivel') ? old('nivel') : $item ?? '') == $request_nivel ? 'selected' : '' }}> {{ $item }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Serie </span> </div>

     <select name="serie" id="serie">
     <option value="all"> Todos </option>
     @foreach(App\Models\Turma::SERIES as $key => $item)
     <option value="{{ $item }}" {{ (old('serie') ? old('serie') : $item ?? '') == $request_serie ? 'selected' : '' }}> {{ $item }} </option>
     @endforeach
     </select>

    </div>

    <div class="selecionar">
    <div class="span"> <span> Disciplina </span> </div>

     <select name="disciplina" id="disciplina">
     <option value="all"> Todos </option>
     @foreach($disciplinas as $disciplina)
     <option value="{{ $disciplina->id }}" {{ (old('disciplina') ? old('disciplina') : $disciplina->id ?? '') == $request_disciplina ? 'selected' : '' }}> {{ $disciplina->nome_da_materia }} </option>
     @endforeach
     </select>

    </div>

    <div class="send">
        <input type="submit" value="➞">  </input>
    </div>

    </div>

    </form>

    <?php

    // total de alunos logica

    use App\Models\Turma;

    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
    $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
    $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

    $query = ''; $where = [];
    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_turno != 'all'){ $where[] = "whereIn('turma_id', ". '$request_t' . ")->"; }
    if($request_nivel != 'all'){ $where[] = "whereIn('turma_id', ". '$request_n' . ")->"; }
    if($request_serie != 'all'){ $where[] = "whereIn('turma_id', ". '$request_s' . ")->"; }
    if($request_ano != 'all'){ $where[] = "where('ano_id', ". $request_ano . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("use App\Models\Cadastro;" . "$" . "alunos = " . "Cadastro::". $query."get();");


    // total de alunos aprovados logica

    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
    $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
    $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

    $query = ''; $where = [];

    if($request_disciplina != 'all'){ $where[] = "->where('disciplina_id', ". $request_disciplina . ")"; }
    if($request_escola != 'all'){ $where[] = "->where('escola_id', ". $request_escola . ")"; }
    if($request_turno != 'all'){ $where[] = "->whereIn('turma_id', ". '$request_t' . ")"; }
    if($request_nivel != 'all'){ $where[] = "->whereIn('turma_id', ". '$request_n' . ")"; }
    if($request_serie != 'all'){ $where[] = "->whereIn('turma_id', ". '$request_s' . ")"; }
    if($request_ano != 'all'){ $where[] = "->where('ano', ". $request_ano . ")"; }

    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("$" . "rf = " . "DB::table('resultado_final')". $query."->get()->toArray(); ");

    $resultadofinal = json_decode(json_encode($rf), true);

    $tmp = array(); foreach($resultadofinal as $r_final) { $tmp[$r_final['aluno_id']][] = $r_final['resultado_final']; }
    $output = array(); foreach($tmp as $aluno_id => $resultado_final) { $output[] = array( 'aluno_id' => $aluno_id, 'resultado_final' => $resultado_final); }
    $aprovados = array_filter($output, fn($output) => !in_array('Não Aprovado', $output['resultado_final']));

    ?>

     <!-- total de alunos -->

      <div class="cards-icons">

          <div class="card-icons"> <div class="card-body"> <div class="card-icon">
          <div class="lab"> <span> total de alunos </span> </div>
          <div class="variavel"> <span> <?php $alunos_total = 0; ?> @foreach($alunos as $aluno)  <?php $alunos_total++ ?> @endforeach <?php echo $alunos_total ?> </span> </div>
          </div> </div> </div>

     <!-- total de alunos aprovados -->

       <div class="card-icons"> <div class="card-body"> <div class="card-icon">
       <div class="lab"> <span> total de alunos aprovados </span> </div>
       <div class="variavel"> <span> </span> <?php echo count($aprovados) ?> </div>
       </div> </div> </div>

     </div>

     <!-- logica % de nota -->

    <?php


    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
    $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
    $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

    $query = ''; $where = [];

    if($request_disciplina != 'all'){ $where[] = "where('disciplina_id', ". $request_disciplina . ")->"; }
    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_turno != 'all'){ $where[] = "whereIn('turma_id', ". '$request_t' . ")->"; }
    if($request_nivel != 'all'){ $where[] = "whereIn('turma_id', ". '$request_n' . ")->"; }
    if($request_serie != 'all'){ $where[] = "whereIn('turma_id', ". '$request_s' . ")->"; }
    if($request_ano != 'all'){ $where[] = "where('ano', ". $request_ano . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    // media anual nota

    eval("use App\Models\ResultadoFinal;" . "$" . "notafinal = " . "ResultadoFinal::". $query. "get()->toArray();");

    $tmp_nota = array(); foreach($notafinal as $n_final) { $tmp_nota[$n_final['aluno_id']][] = $n_final['nota_final']; }
    $output_nota = array(); foreach($tmp_nota as $aluno_id => $nota_final) { $output_nota[] = array( 'aluno_id' => $aluno_id, 'nota_final' => $nota_final); }
    $aprovados_por_nota = array_filter($output_nota, fn($output_nota) => min($output_nota['nota_final']) >= 6);

    if (count($output_nota) == 0) { $media_anual_nota = 0.0;  } else {
    $m_nota = (count($aprovados_por_nota)* 100)/count($output_nota);
    $round_nota = round($m_nota, 2);
    $media_anual_nota = str_replace(",",".", $round_nota); }

    // 1° Bimestre nota

    eval("use App\Models\Notum;" . "$" . "nota_unidade1 = " . "Notum::". $query. "where('bimestre', '1B')->get()->toArray();");

    $tmp_nota_unidade1 = array(); foreach($nota_unidade1 as $n_unidade1) { $tmp_nota_unidade1[$n_unidade1['aluno_id']][] = $n_unidade1['mb']; }
    $output_nota_unidade1 = array(); foreach($tmp_nota_unidade1 as $aluno_id => $mb) { $output_nota_unidade1[] = array( 'aluno_id' => $aluno_id, 'mb' => $mb); }
    $aprovados_nota_unidade1 = array_filter($output_nota_unidade1, fn($output_nota_unidade1) => min($output_nota_unidade1['mb']) >= 6);

    if (count($output_nota_unidade1) == 0) { $media_nota_unidade1 = 0.0; } else {
    $m_nota_unidade1 = (count($aprovados_nota_unidade1)* 100)/count($output_nota_unidade1);
    $round_nota_unidade1 = round($m_nota_unidade1, 2);
    $media_nota_unidade1 = str_replace(",",".", $round_nota_unidade1); }

  // 2° Bimestre nota

    eval("use App\Models\Notum;" . "$" . "nota_unidade2 = " . "Notum::". $query. "where('bimestre', '2B')->get()->toArray();");

    $tmp_nota_unidade2 = array(); foreach($nota_unidade2 as $n_unidade2) { $tmp_nota_unidade2[$n_unidade2['aluno_id']][] = $n_unidade2['mb']; }
    $output_nota_unidade2 = array(); foreach($tmp_nota_unidade2 as $aluno_id => $mb) { $output_nota_unidade2[] = array( 'aluno_id' => $aluno_id, 'mb' => $mb); }
    $aprovados_nota_unidade2 = array_filter($output_nota_unidade2, fn($output_nota_unidade2) => min($output_nota_unidade2['mb']) >= 6);

    if (count($output_nota_unidade2) == 0) { $media_nota_unidade2 = 0.0; } else {
    $m_nota_unidade2 = (count($aprovados_nota_unidade2)* 100)/count($output_nota_unidade2);
    $round_nota_unidade2 = round($m_nota_unidade2, 2);
    $media_nota_unidade2 = str_replace(",",".", $round_nota_unidade2); }

  // 3° Bimestre nota

    eval("use App\Models\Notum;" . "$" . "nota_unidade3 = " . "Notum::". $query. "where('bimestre', '3B')->get()->toArray();");

    $tmp_nota_unidade3 = array(); foreach($nota_unidade3 as $n_unidade3) { $tmp_nota_unidade3[$n_unidade3['aluno_id']][] = $n_unidade3['mb']; }
    $output_nota_unidade3 = array(); foreach($tmp_nota_unidade3 as $aluno_id => $mb) { $output_nota_unidade3[] = array( 'aluno_id' => $aluno_id, 'mb' => $mb); }
    $aprovados_nota_unidade3 = array_filter($output_nota_unidade3, fn($output_nota_unidade3) => min($output_nota_unidade3['mb']) >= 6);

    if (count($output_nota_unidade3) == 0) { $media_nota_unidade3 = 0.0; } else {
    $m_nota_unidade3 = (count($aprovados_nota_unidade3)* 100)/count($output_nota_unidade3);
    $round_nota_unidade3= round($m_nota_unidade3, 2);
    $media_nota_unidade3 = str_replace(",",".", $round_nota_unidade3); }

  // 4° Bimestre nota

    eval("use App\Models\Notum;" . "$" . "nota_unidade4 = " . "Notum::". $query. "where('bimestre', '4B')->get()->toArray();");

    $tmp_nota_unidade4 = array(); foreach($nota_unidade4 as $n_unidade4) { $tmp_nota_unidade4[$n_unidade4['aluno_id']][] = $n_unidade4['mb']; }
    $output_nota_unidade4 = array(); foreach($tmp_nota_unidade4 as $aluno_id => $mb) { $output_nota_unidade4[] = array( 'aluno_id' => $aluno_id, 'mb' => $mb); }
    $aprovados_nota_unidade4 = array_filter($output_nota_unidade4, fn($output_nota_unidade4) => min($output_nota_unidade4['mb']) >= 6);

    if (count($output_nota_unidade4) == 0) { $media_nota_unidade4 = 0.0; } else {
    $m_nota_unidade4 = (count($aprovados_nota_unidade4)* 100)/count($output_nota_unidade4);
    $round_nota_unidade4= round($m_nota_unidade4, 2);
    $media_nota_unidade4 = str_replace(",",".", $round_nota_unidade4); }

    ?>

    <!-- logica % de presença -->

   <?php

   // media anual presença

   $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
   $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
   $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

   $query = ''; $where = [];

   if($request_disciplina != 'all'){ $where[] = "where('disciplina_id', ". $request_disciplina . ")->"; }
   if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
   if($request_turno != 'all'){ $where[] = "whereIn('turma_id', ". '$request_t' . ")->"; }
   if($request_nivel != 'all'){ $where[] = "whereIn('turma_id', ". '$request_n' . ")->"; }
   if($request_serie != 'all'){ $where[] = "whereIn('turma_id', ". '$request_s' . ")->"; }
   if($request_ano != 'all'){ $where[] = "where('ano', ". $request_ano . ")->"; }
   if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }



     eval("use App\Models\ResultadoFinal;" . "$" . "presence = " . "ResultadoFinal::". $query. "get()->toArray();");

    $tmp_presence = array(); foreach($presence as $presence) { $tmp_presence[$presence['aluno_id']][] = $presence['presence']; }
    $output_presence = array(); foreach($tmp_presence as $aluno_id => $presence) { $output_presence[] = array( 'aluno_id' => $aluno_id, 'presence' => $presence); }
    $aprovados_por_presenca = array_filter($output_presence, fn($output_presence) => min($output_presence['presence']) >= 75);

    if (count($output_presence) == 0) { $media_anual_presenca = 0.0;  } else {
    $m_presenca = (count($aprovados_por_presenca)* 100)/count($output_presence);
    $round_presenca = round($m_presenca, 2);
    $media_anual_presenca = str_replace(",",".", $round_presenca); }

    // preseça por Bimestre

    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
    $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
    $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

    $query = ''; $where = [];

    if($request_disciplina != 'all'){ $where[] = "where('disciplina_id', ". $request_disciplina . ")->"; }
    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_turno != 'all'){ $where[] = "whereIn('turmas_id', ". '$request_t' . ")->"; }
    if($request_nivel != 'all'){ $where[] = "whereIn('turmas_id', ". '$request_n' . ")->"; }
    if($request_serie != 'all'){ $where[] = "whereIn('turmas_id', ". '$request_s' . ")->"; }
    if($request_ano != 'all'){ $where[] = "where('ano', ". $request_ano . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }


    // 1° Bimestre presença

     eval("use App\Models\PresencaEletiva;" . "$" . "attendance_unidade1 = " . "PresencaEletiva::". $query. "where('bimestre', '1B')->get()->toArray();");
     eval("use App\Models\PresencaEletiva;" . "$" . "presence_unidade1 = " . "PresencaEletiva::". $query. "where('bimestre', '1B')->where('selecione_falta', '!=' ,'FNJ')->get()->toArray();");

    if (count($attendance_unidade1) == 0) { $presenc_media_1 = 0.00; } else { $presenc_1 = (count($presence_unidade1)* 100)/count($attendance_unidade1);
    $presenc_round_1 = round($presenc_1, 2);
    $presenc_media_1 = str_replace(",",".", $presenc_round_1); }


    // 2° Bimestre presença

    eval("use App\Models\PresencaEletiva;" . "$" . "attendance_unidade2 = " . "PresencaEletiva::". $query. "where('bimestre', '2B')->get()->toArray();");
    eval("use App\Models\PresencaEletiva;" . "$" . "presence_unidade2 = " . "PresencaEletiva::". $query. "where('bimestre', '2B')->where('selecione_falta', '!=' ,'FNJ')->get()->toArray();");

    if (count($attendance_unidade2) == 0) { $presenc_media_2 = 0.00; } else { $presenc_2 = (count($presence_unidade2)* 100)/count($attendance_unidade2);
    $presenc_round_2 = round($presenc_2, 2);
    $presenc_media_2 = str_replace(",",".", $presenc_round_2); }


    // 3° Bimestre presença

    eval("use App\Models\PresencaEletiva;" . "$" . "attendance_unidade3 = " . "PresencaEletiva::". $query. "where('bimestre', '3B')->get()->toArray();");
    eval("use App\Models\PresencaEletiva;" . "$" . "presence_unidade3 = " . "PresencaEletiva::". $query. "where('bimestre', '3B')->where('selecione_falta', '!=' ,'FNJ')->get()->toArray();");

    if (count($attendance_unidade3) == 0) { $presenc_media_3 = 0.00; } else { $presenc_3 = (count($presence_unidade3)* 100)/count($attendance_unidade3);
    $presenc_round_3 = round($presenc_3, 2);
    $presenc_media_3 = str_replace(",",".", $presenc_round_3); }


    // 4° Bimestre presença

    eval("use App\Models\PresencaEletiva;" . "$" . "attendance_unidade4 = " . "PresencaEletiva::". $query. "where('bimestre', '4B')->get()->toArray();");
    eval("use App\Models\PresencaEletiva;" . "$" . "presence_unidade4 = " . "PresencaEletiva::". $query. "where('bimestre', '4B')->where('selecione_falta', '!=' ,'FNJ')->get()->toArray();");

    if (count($attendance_unidade4) == 0) { $presenc_media_4 = 0.00; } else { $presenc_4 = (count($presence_unidade4)* 100)/count($attendance_unidade4);
    $presenc_round_4 = round($presenc_4, 2);
    $presenc_media_4 = str_replace(",",".", $presenc_round_4); }

    ?>

    <!-- logica Desempenho Medio Geral -->

    <?php

    $request_s = Turma::where('serie', $request_serie)->pluck('id')->toArray();
    $request_t = Turma::where('turno', $request_turno)->pluck('id')->toArray();
    $request_n = Turma::where('nivel_da_turma', $request_nivel)->pluck('id')->toArray();

    $query = ''; $where = [];

    if($request_disciplina != 'all'){ $where[] = "where('disciplina_id', ". $request_disciplina . ")->"; }
    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_turno != 'all'){ $where[] = "whereIn('turma_id', ". '$request_t' . ")->"; }
    if($request_nivel != 'all'){ $where[] = "whereIn('turma_id', ". '$request_n' . ")->"; }
    if($request_serie != 'all'){ $where[] = "whereIn('turma_id', ". '$request_s' . ")->"; }
    if($request_ano != 'all'){ $where[] = "where('ano', ". $request_ano . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    // Desempenho Medio 1B Geral

    eval("use App\Models\Notum;" . "$" . "media1b = " . "Notum::". $query. "where('bimestre', '1B')->pluck('mb')->toArray();");

   if (count($media1b) == 0) { $b1_geral = 0.00; } else {
    $calculo_1b = array_sum($media1b)/count($media1b);
    $calculo_round_1b = round($calculo_1b, 2);
    $b1_geral = str_replace(",",".", $calculo_round_1b); }

    // Desempenho Medio 2B Geral

    eval("use App\Models\Notum;" . "$" . "media2b = " . "Notum::". $query. "where('bimestre', '2B')->pluck('mb')->toArray();");

    if (count($media2b) == 0) { $b2_geral = 0.00; } else {
    $calculo_2b = array_sum($media2b)/count($media2b);
    $calculo_round_2b = round($calculo_2b, 2);
    $b2_geral = str_replace(",",".", $calculo_round_2b); }

    // Desempenho Medio 3B Geral

    eval("use App\Models\Notum;" . "$" . "media3b = " . "Notum::". $query. "where('bimestre', '3B')->pluck('mb')->toArray();");

    if (count($media3b) == 0) { $b3_geral = 0.00; } else {
    $calculo_3b = array_sum($media3b)/count($media3b);
    $calculo_round_3b = round($calculo_3b, 2);
    $b3_geral = str_replace(",",".", $calculo_round_3b); }

    // Desempenho Medio 4B Geral

    eval("use App\Models\Notum;" . "$" . "media4b = " . "Notum::". $query. "where('bimestre', '4B')->pluck('mb')->toArray();");

    if (count($media4b) == 0) { $b4_geral = 0.00; } else {
    $calculo_4b = array_sum($media4b)/count($media4b);
    $calculo_round_4b = round($calculo_4b, 2);
    $b4_geral = str_replace(",",".", $calculo_round_4b); }

   // Desempenho Medio Anual Geral

    $calculo = ($b1_geral + $b2_geral + $b3_geral + $b4_geral)/4;
    $calculo_round = round($calculo, 2);
    $ma_geral = str_replace(",",".", $calculo_round);

    ?>

    <div class="table-div">

    <table class="table head table-bordered table-striped table-hover datatable">
    <thead>
      <tr>
      <th> Desempenho Medio Geral </th>
      </tr>
    </thead>
    </table>

    <table class="table table-bordered table-striped table-hover datatable">
    <thead>
     <tr>
     <th> 1° Bimestre </th>
     <th> 2° Bimestre </th>
     <th> 3° Bimestre </th>
     <th> 4° Bimestre </th>
     <th> Media Anual </th>
     </tr>
    </thead>
    <tbody>
     <tr>
     <td> <?php echo $b1_geral; ?> </td>
     <td> <?php echo $b2_geral; ?> </td>
     <td> <?php echo $b3_geral; ?> </td>
     <td> <?php echo $b4_geral; ?> </td>
     <td> <?php echo $ma_geral; ?> </td>
     </tr>
    </tbody>
    </table>

    </div>


 <div id="chart"> </div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="{{ url('reports/icons.css') }}">
<link rel="stylesheet" href="{{ url('reports/performance.css') }}">
@endsection
@section('scripts')
@parent

<script>

var options = {
  series: [{
  name: 'Nota',
data: [ {{ $media_nota_unidade1 }}, {{ $media_nota_unidade2 }}, {{ $media_nota_unidade3 }}, {{ $media_nota_unidade4 }}, {{ $media_anual_nota }} ]
}, {
  name: 'Presença',
  data: [ {{ $presenc_media_1 }}, {{ $presenc_media_2 }}, {{ $presenc_media_3 }}, {{ $presenc_media_4 }}, {{ $media_anual_presenca }} ]
}],
  chart: {
  type: 'bar',
  height: 350
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    endingShape: 'rounded'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  categories: ['1° Bimestre', '2° Bimestre', '3° Bimestre', '4° Bimestre', 'Media Anual'],
},
yaxis: {
  title: {
    text: '% de aprovação'
  }
},
fill: {
  opacity: 1
},
tooltip: {
  y: {
    formatter: function (val) {
      return  val + "% de aprovação"
    }
  }
}
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

</script>

@endsection
