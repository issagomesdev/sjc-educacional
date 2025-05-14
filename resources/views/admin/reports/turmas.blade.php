@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Turmas
    </div>
    </div>

    <form method="GET" action="{{ route("admin.reports.turmas") }}">

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
     <div class="span"> <span> Tipo </span> </div>
      <select name="tipo" id="tipo">
      <option value="all"> Todos </option>
      @foreach(App\Models\Turma::TIPO_RADIO as $key => $item)
      <option value="{{ $key }}" {{ (old('tipo') ? old('tipo') : $key ?? '') == $request_tipo ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
      </select>
      </div>

    <div class="selecionar">
    <div class="span"> <span> Nivel </span> </div>
     <select name="nivel" id="nivel">
     <option value="all"> Todos </option>
     @foreach(App\Models\Turma::NIVEL_DA_TURMA_RADIO as $key => $item)
     <option value="{{ $key }}" {{ (old('nivel') ? old('nivel') : $key ?? '') == $request_nivel ? 'selected' : '' }}>{{ $item }}</option>
     @endforeach
     </select>
     </div>

    <div class="selecionar">
    <div class="span"> <span> Turno </span> </div>
     <select name="turno" id="turno">
     <option value="all"> Todos </option>
     @foreach(App\Models\Turma::TURNO_RADIO as $key => $item)
     <option value="{{ $key }}" {{ (old('turno') ? old('turno') : $key ?? '') == $request_turno ? 'selected' : '' }}>{{ $item }}</option>
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

    <div class="send">
        <input type="submit" value="➞">  </input>
    </div>
    </div>

    </form>

    <?php


    $query = ''; $where = [];

    if($request_escola != 'all'){ $where[] = "where('escola_id', ". $request_escola . ")->"; }
    if($request_serie != 'all'){ $where[] = "where('serie', ". '$request_serie' . ")->"; }
    if($request_tipo != 'all'){ $where[] = "where('tipo_de_turma', ". '$request_tipo' . ")->"; }
    if($request_nivel != 'all'){ $where[] = "where('nivel_da_turma', ". '$request_nivel' . ")->"; }
    if($request_turno != 'all'){ $where[] = "where('turno', ". '$request_turno' . ")->"; }
    if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

    eval("use App\Models\Turma;" . "$" . "turmas = " . "Turma::". $query. "get();");

    $turmas_p = (count($turmas)* 100)/count($turmas_total);
    $round_turmas = round($turmas_p, 2);
    $prctg_turmas = str_replace(",",".", $round_turmas);

    $total_turmas = count($turmas_total) ." Turmas no total";
    $filtro_turmas = count($turmas) ." Turmas filtradas";

    ?>

    <div class="table-div">
    <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-turmas">
      <thead>
          <tr>
            <th class="noExport"> </th>
            <th class="noSorting"> </th>
            <th style="width: 50%;" aria-sort="none"> Escola </th>
            <th style="width: 50%;" aria-sort="none"> Tipo de Turma </th>
            <th style="width: 50%;" aria-sort="none"> Nivel de Ensino </th>
            <th style="width: 50%;" aria-sort="none"> Turno </th>
            <th style="width: 50%;" aria-sort="none"> Serie </th>
            <th style="width: 50%;" aria-sort="none"> Total de Vagas </th>
            <th style="width: 50%;" aria-sort="none"> Total de Alunos </th>
            <th style="width: 50%;" aria-sort="none"> Total de Vagas disponíveis </th>
          </tr>
        <tbody>
          @foreach($turmas as $key => $turma)
              <tr data-entry-id="{{ $turma->id }}">
                  <td> </td>
                  <td> </td>
                  <td>
                      {{ $turma->escola->name }}
                  </td>
                  <td>
                      {{ $turma->nivel_da_turma }}
                  </td>
                  <td>
                      {{ $turma->tipo_de_turma }}
                  </td>
                  <td>
                      {{ $turma->turno }}
                  </td>
                  <td>
                      {{ $turma->serie }} {{ $turma->identificacao }}
                  </td>
                  <td> @if($turma->turmaVagas->count() == 0) Não Atribuido @endif @foreach($turma->turmaVagas as $vagas)  {{ $vagas->total_de_vadas }} @endforeach </td>
                  <td> <?php $total_alunos = 0; ?> @foreach($alunos as $aluno) @if($aluno->escola_id == $turma->escola_id && $aluno->turma_id == $turma->id) <?php $total_alunos++ ?> @endif @endforeach <?php echo $total_alunos ?> </td>
                  <td> @if($turma->turmaVagas->count() == 0) 0 @endif @foreach($turma->turmaVagas as $vagas) {{ $vagas->total_de_vadas - $total_alunos }} @endforeach</td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>

<div id="chart"> </div>

<div class="card">
    <div class="card-header">
        Relatórios Distorção Idade-Série
    </div>
    </div>

<!-- acesso geral -->
@if(is_null($request_escola))
@foreach(App\Models\Turma::SERIES as $key => $item)

    <div class="idade-serie">

    <table id="serie" class="table table-bordered table-striped table-hover datatable serie">
      <thead>
      <tr>
        <td class="serie"> {{ $item }} </td>
      </tr>
      </thead>
    </table>

<table id="dates" class=" table table-bordered table-striped table-hover datatable dates">
  <thead>
  <tr>
    <td class="idade"> Idade </td>
    <td class="idade"> 5 </td>
    <td class="idade"> 6 </td>
    <td class="idade"> 7 </td>
    <td class="idade"> 8 </td>
    <td class="idade"> 9 </td>
    <td class="idade"> 10 </td>
    <td class="idade"> 11 </td>
    <td class="idade"> 12 </td>
    <td class="idade"> 13 </td>
    <td class="idade"> 14 </td>
    <td class="idade"> 15</td>
    <td class="idade"> 16 </td>
    <td class="idade"> 17 </td>
    <td class="idade"> +18 </td>
    <td class="idade"> Total </td>
  </tr>
  <tr>
    <td class="alunos"> Alunos </td>
    <!-- 5 -->
    <td>
    <?php $i5 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 5) <?php $i5++ ?> @endif @endif @endforeach  <?php echo $i5 ?>
    </td>
    <!-- 6 -->
    <td>
    <?php $i6 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 6) <?php $i6++ ?> @endif @endif @endforeach  <?php echo $i6 ?>
    </td>
    <!-- 7 -->
    <td>
    <?php $i7 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 7) <?php $i7++ ?> @endif @endif @endforeach <?php echo $i7 ?>
    </td>
    <!-- 8 -->
    <td>
    <?php $i8 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 8) <?php $i8++ ?> @endif @endif @endforeach  <?php echo $i8 ?>
    </td>
    <!-- 9 -->
    <td>
    <?php $i9 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 9) <?php $i9++ ?> @endif @endif @endforeach  <?php echo $i9 ?>
    </td>
    <!-- 10 -->
    <td>
    <?php $i10 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 10) <?php $i10++ ?> @endif @endif @endforeach  <?php echo $i10 ?>
    </td>
    <!-- 11 -->
    <td>
    <?php $i11 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 11) <?php $i11++ ?> @endif @endif @endforeach  <?php echo $i11 ?>
    </td>
    <!-- 12 -->
    <td>
    <?php $i12 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 12) <?php $i12++ ?> @endif @endif @endforeach  <?php echo $i12 ?>
    </td>
    <!-- 13 -->
    <td>
    <?php $i13 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 13) <?php $i13++ ?> @endif @endif @endforeach  <?php echo $i13 ?>
    </td>
    <!-- 14 -->
    <td>
    <?php $i14 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 14) <?php $i14++ ?> @endif @endif @endforeach  <?php echo $i14 ?>
    </td>
    <!-- 15 -->
    <td>
    <?php $i15 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 15) <?php $i15++ ?> @endif @endif @endforeach  <?php echo $i15 ?>
    </td>
    <!-- 16 -->
    <td>
    <?php $i16 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 16) <?php $i16++ ?> @endif @endif @endforeach  <?php echo $i16 ?>
    </td>
    <!-- 17 -->
    <td>
    <?php $i17 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 17) <?php $i17++ ?> @endif @endif @endforeach  <?php echo $i17 ?>
    </td>
    <!-- +18 -->
    <td>
    <?php $i18 = 0; ?> @foreach($estudantes as $key => $estudante) @if($estudante->turma->serie == $item)
    <?php $bd = "{$estudante->data_de_nascimento}/{$estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade >= 18) <?php $i18++ ?> @endif @endif @endforeach  <?php echo $i18 ?>
    </td>
    <!-- total -->
    <td>
    <?php $total = 0; ?> @foreach($estudantes as $key => $estudante)
    @if($estudante->turma->serie == $item)  <?php $total++ ?> @endif @endforeach  <?php echo $total ?>
    </td>
  </tr>
  <tr>
    <td class="prcnt"> % </td>
    <!-- 5 -->
    <td>
    <?php if($i5 == 0) { $prcnt = 0; } else { $prcnt = ($i5*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 6 -->
    <td>
    <?php if($i6 == 0) { $prcnt = 0; } else { $prcnt = ($i6*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 7 -->
    <td>
    <?php if($i7 == 0) { $prcnt = 0; } else { $prcnt = ($i7*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 8 -->
    <td>
    <?php if($i8 == 0) { $prcnt = 0; } else { $prcnt = ($i8*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 9 -->
    <td>
    <?php if($i9 == 0) { $prcnt = 0; } else { $prcnt = ($i9*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 10 -->
    <td>
    <?php if($i10 == 0) { $prcnt = 0; } else { $prcnt = ($i10*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 11 -->
    <td>
    <?php if($i11 == 0) { $prcnt = 0; } else { $prcnt = ($i11*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 12 -->
    <td>
    <?php if($i12 == 0) { $prcnt = 0; } else { $prcnt = ($i12*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 13 -->
    <td>
    <?php if($i13 == 0) { $prcnt = 0; } else { $prcnt = ($i13*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 14 -->
    <td>
    <?php if($i14 == 0) { $prcnt = 0; } else { $prcnt = ($i14*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 15 -->
    <td>
    <?php if($i15 == 0) { $prcnt = 0; } else { $prcnt = ($i15*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 16 -->
    <td>
    <?php if($i16 == 0) { $prcnt = 0; } else { $prcnt = ($i16*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 17 -->
    <td>
    <?php if($i17 == 0) { $prcnt = 0; } else { $prcnt = ($i17*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 18 -->
    <td>
    <?php if($i18 == 0) { $prcnt = 0; } else { $prcnt = ($i18*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <td> 100% </td>
  </tr>
  </thead>
</table>

</div>

@endforeach
@else

<!-- acesso geral -->

@foreach(App\Models\Turma::SERIES as $key => $item)

    <div class="idade-serie" style="overflow-x:auto;">

    <table id="serie" class="table table-bordered table-striped table-hover datatable serie">
      <thead>
      <tr>
        <td class="serie"> {{ $item }} </td>
      </tr>
      </thead>
    </table>

<table id="dates" class=" table table-bordered table-striped table-hover datatable dates">
  <thead>
  <tr>
    <td class="idade"> Idade </td>
    <td class="idade"> 5 </td>
    <td class="idade"> 6 </td>
    <td class="idade"> 7 </td>
    <td class="idade"> 8 </td>
    <td class="idade"> 9 </td>
    <td class="idade"> 10 </td>
    <td class="idade"> 11 </td>
    <td class="idade"> 12 </td>
    <td class="idade"> 13 </td>
    <td class="idade"> 14 </td>
    <td class="idade"> 15</td>
    <td class="idade"> 16 </td>
    <td class="idade"> 17 </td>
    <td class="idade"> +18 </td>
    <td class="idade"> Total </td>
  </tr>
  <tr>
    <td class="alunos"> Alunos </td>
    <!-- 5 -->
    <td>
    <?php $i5 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 5) <?php $i5++ ?> @endif @endif @endforeach  <?php echo $i5 ?>
    </td>
    <!-- 6 -->
    <td>
    <?php $i6 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 6) <?php $i6++ ?> @endif @endif @endforeach  <?php echo $i6 ?>
    </td>
    <!-- 7 -->
    <td>
    <?php $i7 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 7) <?php $i7++ ?> @endif @endif @endforeach <?php echo $i7 ?>
    </td>
    <!-- 8 -->
    <td>
    <?php $i8 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 8) <?php $i8++ ?> @endif @endif @endforeach  <?php echo $i8 ?>
    </td>
    <!-- 9 -->
    <td>
    <?php $i9 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 9) <?php $i9++ ?> @endif @endif @endforeach  <?php echo $i9 ?>
    </td>
    <!-- 10 -->
    <td>
    <?php $i10 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 10) <?php $i10++ ?> @endif @endif @endforeach  <?php echo $i10 ?>
    </td>
    <!-- 11 -->
    <td>
    <?php $i11 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 11) <?php $i11++ ?> @endif @endif @endforeach  <?php echo $i11 ?>
    </td>
    <!-- 12 -->
    <td>
    <?php $i12 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 12) <?php $i12++ ?> @endif @endif @endforeach  <?php echo $i12 ?>
    </td>
    <!-- 13 -->
    <td>
    <?php $i13 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 13) <?php $i13++ ?> @endif @endif @endforeach  <?php echo $i13 ?>
    </td>
    <!-- 14 -->
    <td>
    <?php $i14 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 14) <?php $i14++ ?> @endif @endif @endforeach  <?php echo $i14 ?>
    </td>
    <!-- 15 -->
    <td>
    <?php $i15 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 15) <?php $i15++ ?> @endif @endif @endforeach  <?php echo $i15 ?>
    </td>
    <!-- 16 -->
    <td>
    <?php $i16 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 16) <?php $i16++ ?> @endif @endif @endforeach  <?php echo $i16 ?>
    </td>
    <!-- 17 -->
    <td>
    <?php $i17 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade == 17) <?php $i17++ ?> @endif @endif @endforeach  <?php echo $i17 ?>
    </td>
    <!-- +18 -->
    <td>
    <?php $i18 = 0; ?> @foreach($c_estudantes as $key => $c_estudante) @if($c_estudante->turma->serie == $item)
    <?php $bd = "{$c_estudante->data_de_nascimento}/{$c_estudante->ano_de_nascimento}";
    $data = $bd;
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); ?>
    @if($idade >= 18) <?php $i18++ ?> @endif @endif @endforeach  <?php echo $i18 ?>
    </td>
    <!-- total -->
    <td>
    <?php $total = 0; ?> @foreach($c_estudantes as $key => $c_estudante)
    @if($c_estudante->turma->serie == $item)  <?php $total++ ?> @endif @endforeach  <?php echo $total ?>
    </td>
  </tr>
  <tr>
    <td class="prcnt"> % </td>
    <!-- 5 -->
    <td>
    <?php if($i5 == 0) { $prcnt = 0; } else { $prcnt = ($i5*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 6 -->
    <td>
    <?php if($i6 == 0) { $prcnt = 0; } else { $prcnt = ($i6*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 7 -->
    <td>
    <?php if($i7 == 0) { $prcnt = 0; } else { $prcnt = ($i7*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 8 -->
    <td>
    <?php if($i8 == 0) { $prcnt = 0; } else { $prcnt = ($i8*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 9 -->
    <td>
    <?php if($i9 == 0) { $prcnt = 0; } else { $prcnt = ($i9*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 10 -->
    <td>
    <?php if($i10 == 0) { $prcnt = 0; } else { $prcnt = ($i10*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 11 -->
    <td>
    <?php if($i11 == 0) { $prcnt = 0; } else { $prcnt = ($i11*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 12 -->
    <td>
    <?php if($i12 == 0) { $prcnt = 0; } else { $prcnt = ($i12*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 13 -->
    <td>
    <?php if($i13 == 0) { $prcnt = 0; } else { $prcnt = ($i13*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 14 -->
    <td>
    <?php if($i14 == 0) { $prcnt = 0; } else { $prcnt = ($i14*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 15 -->
    <td>
    <?php if($i15 == 0) { $prcnt = 0; } else { $prcnt = ($i15*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 16 -->
    <td>
    <?php if($i16 == 0) { $prcnt = 0; } else { $prcnt = ($i16*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 17 -->
    <td>
    <?php if($i17 == 0) { $prcnt = 0; } else { $prcnt = ($i17*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <!-- 18 -->
    <td>
    <?php if($i18 == 0) { $prcnt = 0; } else { $prcnt = ($i18*100) / $total; } echo round($prcnt, 2) ?>%
    </td>
    <td> 100% </td>
  </tr>
  </thead>
</table>

</div>

@endforeach
@endif

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="{{ url('reports/teams.css') }}">

<style>

.send {
    margin-left: 10px;
}

</style>

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
 let table = $('.datatable-turmas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
          data: [100, {{ $prctg_turmas }}]
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
         categories: ['{{ $total_turmas }}', '{{ $filtro_turmas }}'],
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
