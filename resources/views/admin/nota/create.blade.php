@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-body">
@foreach($turma as $turma) @endforeach
@if( $turma->nivel_da_turma == 'Ensino Infantil')

        <form method="POST" action="{{ route("admin.nota.new") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
            <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
            <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
            <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
            <div class="table-responsive">

              <div class="form-aluno">
                  <label class="required" for="aluno_id">{{ trans('cruds.matricula.fields.aluno') }}</label>
                  <select class="form-control selectd {{ $errors->has('aluno') ? 'is-invalid' : '' }}" name="aluno_id" id="aluno_id" required>
                    <option value="">Selecione por favor</option>
                      @foreach($alunos as $aluno)
                          <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome_completo }}</option>
                      @endforeach
                  </select>
                  </div>

<!-- 1 -->
<table class=" table-sm table-bordered table-striped table-hover datatable">
<thead>
<tr>
<th> CONHECENDO O CONTEXTO DOS BEBÊS E/OU CRIANÇAS BEM PEQUENAS. </th> <!-- 2 -->
</tr>
</thead>
<tbody>
<tr>
<fieldset id="conhecendo_contexto">
<td>
<textarea class="form-control ckeditor" name="conhecendo_contexto" id="conhecendo_contexto">
{!! old('conhecendo_contexto') !!}</textarea>
</td>
</fieldset>
</tr>
</tbody>
</table>

<!-- 2 -->
<table class=" table-sm table-bordered table-striped table-hover datatable">
<thead>
<tr>
<th> REGISTROS DAS CONQUISTAS HISTÓRICAS DO PROCESSO EVOLUTIVO E NATURAL DA APREDIZAGEM E DESENVOLVIMENTO DOS BEBÊS E/OU CRIANÇAS BEM PEQUENAS. </th>
</tr>
</thead>
<tbody>
<tr>
<fieldset id="registro_conquistas">
<td>
<textarea class="form-control ckeditor" name="registro_conquistas" id="registro_conquistas">
{!! old('registro_conquistas') !!}</textarea>
</td>
</fieldset>
</tr>
</tbody>
</table>

<!-- 3 -->
<table class="table-sm table-bordered table-striped table-hover datatable">
<thead>
<tr>
<th class="lab"> ACOMPANHAMENTO DOS OBJETIVOS ARTICULADOS ÁS EXPERIÊNCIAS VIVENCIADAS PELOS BEBÊS E/OU CRIANÇAS BEM PEQUENAS. </th> <!-- 2 -->
<th></th>
<th></th>
</tr>
</thead>
<thead>
<tr>
<th class="lab"> OBJETIVOS DE APRENDIZAGEM E DESENVOLVIMENTO. </th>
<th class="semes"> SEMESTRES </th>
<th></th>
</tr>
</thead>
<thead>
<tr>
<th class="lab"> O EU, O OUTRO E O NÓS - 0 A 1 ANO E 6 MESES. </th>
<th class="sem"> I </th>
<th class="sem"> II </th>
</tr>
</thead>
<tbody>
<tr>
<td> <strong>(EI01EO01PE)</strong> Perceber que suas ações tem efeitos em si, nas outras crianças e nos adultos a sua volta, constituindo relações de amizade, em diversos ambientes sociais e culturais, a partir de situações do cotidiano e de brincadeiras. </td>
<td> <input class="form-input" type="checkbox" name="01EO01_s1" id="01EO01_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO01_s2" id="01EO01_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO02PE)</strong> Perceber suas possibilidades e os limites de seu corpo nas brincadeiras e interações das quais participa no seu convívio social. </td>
<td> <input class="form-input" type="checkbox" name="01EO02_s1" id="01EO02_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO02_s2" id="01EO02_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO03PE)</strong> Interagir com crianças da mesma e de outras faixas etárias e com adultos, ao explorar espaços, materiais, objetos, brinquedos e brincadeiras. </td>
<td> <input class="form-input" type="checkbox" name="01EO03_s1" id="01EO03_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO03_s2" id="01EO03_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO04PE)</strong> Comunicar necessidades, desejos e emoções, utilizando gestos, balbucios, palavras. </td>
<td> <input class="form-input" type="checkbox" name="01EO04_s1" id="01EO04_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO04_s2" id="01EO04_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO05PE)</strong> Reconhecer as sensações do seu corpo em momentos de alimentação, higiene, brincadeira e descanso. </td>
<td> <input class="form-input" type="checkbox" name="01EO05_s1" id="01EO05_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO05_s2" id="01EO05_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO06PE)</strong> Interagir com outras crianças da mesma e de outras faixas etárias e com adultos adaptando-se ao convívio sociocultural, através de experiências cotidianas lúdicas. </td>
<td> <input class="form-input" type="checkbox" name="01EO06_s1" id="01EO06_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO06_s2" id="01EO06_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01EO07PE)</strong> Interagir com outras crianças da mesma e de outras faixas etárias e com adultos adaptando-se ao convívio sociocultural, através de experiências cotidianas lúdicas. </td>
<td> <input class="form-input" type="checkbox" name="01EO07_s1" id="01EO07_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01EO07_s2" id="01EO07_s2" value="1"> </td>
</tr>
</tbody>
<thead>
<tr>
<th class="lab"> O EU, O OUTRO E O NÓS - 1 ANO E 7 MESES A 3 ANOS E 11 MESES. </th> <!-- 2 -->
<th class="sem"> I </th>
<th class="sem"> II </th>
</tr>
</thead>
<tbody>
<tr>
<td> <strong>(EI02EO01PE)</strong> Interagir com outras crianças da mesma e de outras faixas etárias e com adultos adaptando-se ao convívio sociocultural, através de experiências cotidianas lúdicas. </td>
<td> <input class="form-input" type="checkbox" name="02EO01_s1" id="02EO01_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO01_s2" id="02EO01_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02EO02PE)</strong> Demonstrar imagem positiva de si e confiança para enfrentar dificuldades e desafios em diferentes contextos. </td>
<td> <input class="form-input" type="checkbox" name="02EO02_s1" id="02EO02_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO02_s2" id="02EO02_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02EO03PE)</strong> Comunicar-se com os colegas e os adultos, buscando compreendê-los e fazendo-se compreender. </td>
<td> <input class="form-input" type="checkbox" name="02EO03_s1" id="02EO03_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO03_s2" id="02EO03_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02EO04PE)</strong> Comunicar-se com os colegas e os adultos, buscando compreendê-los e fazendo-se compreender. </td>
<td> <input class="form-input" type="checkbox" name="02EO04_s1" id="02EO04_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO04_s2" id="02EO04_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02EO05PE)</strong> Perceber que as pessoas têm preferências e características físicas diferentes (altura, cor de olhos, cor da pele, tipos de cabelos, etc.), respeitando essas diferenças. </td>
<td> <input class="form-input" type="checkbox" name="02EO05_s1" id="02EO05_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO05_s2" id="02EO05_s2" value="1"> </td>
</tr>
<td> <strong>(EI02EO06PE)</strong> Fazer uso de normas sociais, participando de brincadeiras, pertencentes à cultura local. </td>
<td> <input class="form-input" type="checkbox" name="02EO06_s1" id="02EO06_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO06_s2" id="02EO06_s2" value="1"> </td>
</tr>
<td> <strong>(EI02EO07PE)</strong> Utilizar suas habilidades comunicativas, ampliando a compreensão das mensagens dos colegas para resolução de conflitos. </td>
<td> <input class="form-input" type="checkbox" name="02EO07_s1" id="02EO07_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02EO07_s2" id="02EO07_s2" value="1"> </td>
</tr>
</tbody>
<thead>
<tr>
<th class="lab"> ESPAÇOS, TEMPOS, QUANTIDADES, RELAÇÕES E TRANSFORMAÇÕES - 0 A 1 ANO E 6 MESES. </th>
<th class="sem"> I </th>
<th class="sem"> II </th>
</tr>
</thead>
<tbody>
<tr>
<td> <strong>(EI01ET01PE)</strong> Explorar e descobrir as propriedades de objetos e materiais concretos (odores, cores, sabores, temperaturas, consistências, texturas e formas). </td>
<td> <input class="form-input" type="checkbox" name="01ET01_s1" id="01ET01_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET01_s2" id="01ET01_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET02PE)</strong> Explorar relações de causa e efeito (transbordar, tingir, misturar, mover e remover, etc.) na interação com o mundo físico. </td>
<td> <input class="form-input" type="checkbox" name="01ET02_s1" id="01ET02_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET02_s2" id="01ET02_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET03PE)</strong> Explorar o ambiente pela ação e observação, manipulando, experimentando e fazendo descobertas, identificando nos seres vivos, tamanho, cheiro, som, cores, e percebendo o movimento de pessoas e etc. </td>
<td> <input class="form-input" type="checkbox" name="01ET03_s1" id="01ET03_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET03_s2" id="01ET03_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET04PE)</strong> Manipular, experimentar, arrumar e explorar diferentes espaços com diversos desafios. por meio de experiências de deslocamentos de si e dos objetos. </td>
<td> <input class="form-input" type="checkbox" name="01ET04_s1" id="01ET04_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET04_s2" id="01ET04_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET05PE)</strong> Manipular materiais diversos e variados para perceber as diferenças e semelhanças entre eles. </td>
<td> <input class="form-input" type="checkbox" name="01ET05_s1" id="01ET05_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET05_s2" id="01ET05_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET06PE)</strong> Vivenciar diferentes ritmos, velocidades e fluxos nas interações e brincadeiras (em danças, balanços, escorregos , etc.). </td>
<td> <input class="form-input" type="checkbox" name="01ET06_s1" id="01ET06_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET06_s2" id="01ET06_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET07PE)</strong> Vivenciar brincadeiras que despertem interesse e curiosidade por fenômenos da natureza (chuva, seca, vento, correnteza, etc.). </td>
<td> <input class="form-input" type="checkbox" name="01ET07_s1" id="01ET07_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET07_s2" id="01ET07_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET08PE)</strong> Experimentar livremente as diversas formas de deslocamento no espaço |(correr pular, andar, engatinhar, rolar, subir, descer entre outros). </td>
<td> <input class="form-input" type="checkbox" name="01ET08_s1" id="01ET08_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET08_s2" id="01ET08_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI01ET09PE)</strong> Explorar o ambiente natural externo da unidade por meio de passeios. </td>
<td> <input class="form-input" type="checkbox" name="01ET09_s1" id="01ET09_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="01ET09_s2" id="01ET09_s2" value="1"> </td>
</tr>
</tbody>
<thead>
<tr>
<th class="lab"> ESPAÇOS, TEMPOS, QUANTIDADES, RELAÇÕES E TRANSFORMAÇÕES - 1 ANO E 7 MESES A 3 ANOS E 11 MESES. </th>
<th class="sem"> I </th>
<th class="sem"> II </th>
</tr>
</thead>
<tbody>
<tr>
<td> <strong>(EI02ET01PE)</strong> Explorar e descrever semelhanças e diferenças entre as características e propriedades dos objetos (textura, massa, tamanho, etc.), através da manipulação do material concreto. </td>
<td> <input class="form-input" type="checkbox" name="02ET01_s1" id="02ET01_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET01_s2" id="02ET01_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET02PE)</strong> Observar, relatar e descrever incidentes do cotidiano e fenômenos naturais (luz solar, vento, chuva, etc.). </td>
<td> <input class="form-input" type="checkbox" name="02ET02_s1" id="02ET02_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET02_s2" id="02ET02_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET03PE)</strong> Compartilhar e explorar, com outras crianças, situações de cuidado de pantas e animais nos espaços da instituição e fora dela, despertando para consciência ambiental e a formação cidadã. </td>
<td> <input class="form-input" type="checkbox" name="02ET03_s1" id="02ET03_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET03_s2" id="02ET03_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET04PE)</strong> Identificar relações espaciais (dentro e fora, em cima, embaixo, acima, abaixo, longe e perto, entre e do lado) e temporais (antes, durante e depois), em diversas ações do cotidiano. </td>
<td> <input class="form-input" type="checkbox" name="02ET04_s1" id="02ET04_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET04_s2" id="02ET04_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET05PE)</strong> Classificar objetos, a partir de determinados atributos (tamanho, massa, cor, forma, espessura, etc.), utilizando materiais concretos. </td>
<td> <input class="form-input" type="checkbox" name="02ET05_s1" id="02ET05_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET05_s2" id="02ET05_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET06PE)</strong> Utilizar conceitos básicos (agora, depois, depressa, devagar), nas situações as do cotidiano. </td>
<td> <input class="form-input" type="checkbox" name="02ET06_s1" id="02ET06_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET06_s2" id="02ET06_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET07PE)</strong> Contar oralmente objetos, pessoas, livros, etc., nas situações diversas e em diversos significativos. </td>
<td> <input class="form-input" type="checkbox" name="02ET07_s1" id="02ET07_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET07_s2" id="02ET07_s2" value="1"> </td>
</tr>
<tr>
<td> <strong>(EI02ET08PE)</strong> Registrar quantidades em diferentes formas (números, gráficos, objetos, etc.) nas situações diversas e em contextos significativos. </td>
<td> <input class="form-input" type="checkbox" name="02ET08_s1" id="02ET08_s1" value="1"> </td>
<td> <input class="form-input" type="checkbox" name="02ET08_s2" id="02ET08_s2" value="1"> </td>
</tr>
</tbody>
</table>
<!-- 4 -->

<table class=" table-sm table-bordered table-striped table-hover datatable">
<thead>
<tr>
<th> PARECER DESCRITIVO DA APRENDIZAGEM E DESENVOLVIMENTO. </th>
</tr>
<tr>
<th> I SEMESTRE </th>
</tr>
</thead>
<tbody>
<tr>
<fieldset id="parecer_descritivo_s1">
<td>
<textarea class="form-control ckeditor" name="parecer_descritivo_s1" id="parecer_descritivo_s1">
{!! old('parecer_descritivo_s1') !!}</textarea>
</td>
</fieldset>
</tr>
</tbody>
<thead>
<tr>
<th> II SEMESTRE </th>
</tr>
</thead>
<tbody>
<tr>
<fieldset id="parecer_descritivo_s2">
<td>
<textarea class="form-control ckeditor" name="parecer_descritivo_s2" id="parecer_descritivo_s2">
{!! old('parecer_descritivo_s2') !!}</textarea>
</td>
</fieldset>
</tr>
</tbody>
</table>
</div>



<input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
<input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">

<div class="form-btn">
<input class="btn btn-add" type="submit" value="Adicionar">
</div>
</form>
</div>
@else

@if(is_countable($notum) && count($notum) > 0)

<div class="sregistros">
  <p class="mensage"> Um registros de notas ja foi criado na escola selecionada, para a turma selecionada, na disciplina, ano e bimestre selecionado, refaça suas seleções no espaço <strong>Atualizar Registro Existente</strong> para realizar modificações. </p>
</div>

@else

@if($request_bimestre == 'RF')

<div class="table-responsive">
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                    <thead>
                      <tr>
                        <th class="space"> </th>
                        <th> Aluno</th>
                        <th> Media Final </th>
                        <th> % de Presença </th>
                        <th class="tipo"> Tipo de aprovação </th>
                        <th class="final"> Resultado Final </th>
                        <th> Detalhes </th>
                      </tr>
                    </thead>
                    <tbody>
                      <form method="POST" action="{{ route("admin.nota.up-resultado") }}" enctype="multipart/form-data">
                          @csrf

                          <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
                          <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
                          <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
                          <input type="hidden" class="disciplina_id" value="{{ $request_disciplina }}" for="disciplina_id" name="disciplina_id">
                          <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
                          @foreach($alunos as $aluno)

                          <!-- logica -->
                          @foreach($unidade1 as $n1) @if($n1->aluno_id == $aluno->id) <?php if(abs($n1->mb > $n1->rec)) { $nota1 = $n1->mb; } else { $nota1 = $n1->rec; } ?> @endif @endforeach
                          @foreach($unidade2 as $n2) @if($n2->aluno_id == $aluno->id) <?php if(abs($n2->mb > $n2->rec)) { $nota2 = $n2->mb; } else { $nota2 = $n2->rec; } ?> @endif @endforeach
                          @foreach($unidade3 as $n3) @if($n3->aluno_id == $aluno->id) <?php if(abs($n3->mb > $n3->rec)) { $nota3 = $n3->mb; } else { $nota3 = $n3->rec; } ?> @endif @endforeach
                          @foreach($unidade4 as $n4) @if($n4->aluno_id == $aluno->id) <?php if(abs($n4->mb > $n4->rec)) { $nota4 = $n4->mb; } else { $nota4 = $n4->rec; } $div = 4; $total = ($nota1 + $nota2 + $nota3 + $nota4) / $div; ?> @endif @endforeach
                          @foreach($mrecf as $recf) @if($recf->aluno_id == $aluno->id) <?php if(abs($total > $recf->mrecf)) { $nota_final = $total; } else { $nota_final = $recf->mrecf; } ?> @endif @endforeach
                          <?php $t_aulas = 0; ?> @foreach($total_aulas as $total_aula) @if($total_aula->alunos_id == $aluno->id) <?php $t_aulas++ ?>  @endif @endforeach
                          <?php $pres = 0; ?> @foreach($presences as $presence) @if($presence->alunos_id == $aluno->id) <?php $pres++ ?>  @endif @endforeach
                          <?php if ($t_aulas == 0) { $porcent = 100; } else { $porcent = $pres/$t_aulas * 100; } ?>
                          <?php if ($porcent >= 70) { $resultado = 1; } else { $resultado = 2; } ?>


                          <?php

                          if($resultado == 2) {  $resultado_final = 'Não Aprovado'; $detalhes = 'Porcentagem de comparecimento abaixo do requisitado, resultado final: não aprovado.'; }


                          else {

                            if($nota_final >= 6) { $resultado_final = 'Aprovado'; $detalhes = 'Porcentagem de comparecimento e media final igual ou acima do requisitado, resultado final: aprovado.'; }
                            elseif($nota_final < 6) { $resultado_final = 'Não Aprovado'; $detalhes = 'Media Final abaixo do requisitado, resultado final: não aprovado.'; }

                          }

                           ?>

                          <!--  -->
                          @foreach($mrecf as $mrec) @if($mrec->aluno_id == $aluno->id)

                            <td> </td>
                            <td> <input type="hidden" class="aluno" value="{{ $aluno->id }}" for="aluno_id" name="aluno_id-{{ $aluno->id }}"> {{ $aluno->nome_completo }}</td>
                            <td> <input type="hidden" class="nota_final" value="<?php echo round($nota_final, 2) ?>" for="nota_final" name="nota_final-{{ $aluno->id }}"> <?php echo round($nota_final, 2) ?> </td>
                            <td> <input type="hidden" class="presence" value="<?php echo round($porcent, 2) ?>" for="presence" name="presence-{{ $aluno->id }}"> <?php echo round($porcent, 2) ?>% </td>
                            <td>
                              <select class="form-control2" name="tipo_aprovacao-{{ $aluno->id }}" id="tipo_aprovacao_{{ $aluno->id }}">
                                  <option data-tipo="1" value="Aprovação Manual"> Aprovação Manual </option>
                                  <option data-tipo="2" value="Aprovação Automatica" selected> Aprovação Automatica </option>
                              </select>
                              </td>
                              <td> <div class="tipo_1" id="tipo_1_{{ $aluno->id }}">  <?php echo $resultado_final ?>
                               <input type="hidden" value="{{ $resultado_final }}" id="final2_{{ $aluno->id }}" name="final-{{ $aluno->id }}">  </div>
                              <select class="form-control2" name="final-{{ $aluno->id }}" id="final_{{ $aluno->id }}">
                                  <option value="Aprovado" {{ $resultado_final === (string) 'Aprovado' ? 'selected' : '' }}> Aprovado </option>
                                  <option value="Não Aprovado" {{ $resultado_final === (string) 'Não Aprovado' ? 'selected' : '' }}> Não Aprovado </option>
                                  <option value="Aprovado No Conselho" {{ $resultado_final === (string) 'Aprovado pelo conselho' ? 'selected' : '' }}> Aprovado No Conselho </option>
                              </select>
                            </td>
                            <td> <div class="detalhes_1" id="detalhes_1_{{ $aluno->id }}"> <?php echo $detalhes; ?>
                              <input type="hidden" value="{{ $detalhes }}" id="detalhes2_{{ $aluno->id }}" name="detalhes-{{ $aluno->id }}"> </div>
                              <textarea class="form-control" name="detalhes-{{ $aluno->id }}" id="detalhes_{{ $aluno->id }}">
                              {!! old('conhecendo_contexto') !!}</textarea> </td>
                            </tr>

                            @section('scripts')
                            @parent

                            <script>

                            $(document).ready(function () {
                                toggleFields{{ $aluno->id }}();
                                $("#tipo_aprovacao_{{ $aluno->id }}").change(function () {
                                    toggleFields{{ $aluno->id }}();
                                });
                            });

                            function toggleFields{{ $aluno->id }}() {
                                if ($("#tipo_aprovacao_{{ $aluno->id }} option:selected").data('tipo') == '1' ) {
                                    $("#tipo_1_{{ $aluno->id }}").hide();
                                    $("select#final_{{ $aluno->id }}").attr('required', 1);
                                    $("select#final_{{ $aluno->id }}").removeAttr('disabled');
                                    $("input#final2_{{ $aluno->id }}").attr('disabled', 1);
                                    $("select#final_{{ $aluno->id }}").show();

                                    $("#detalhes_1_{{ $aluno->id }}").hide();
                                    $("textarea#detalhes_{{ $aluno->id }}").show();
                                    $("textarea#detalhes_{{ $aluno->id }}").removeAttr('disabled');
                                    $("textarea#detalhes_{{ $aluno->id }}").attr('required', 1);
                                    $("input#detalhes2_{{ $aluno->id }}").attr('disabled', 1);
                                } else {
                                    $("#tipo_1_{{ $aluno->id }}").show();
                                    $("select#final_{{ $aluno->id }}").removeAttr('required');
                                    $("select#final_{{ $aluno->id }}").attr('disabled', 1);
                                    $("input#final2_{{ $aluno->id }}").removeAttr('disabled');
                                    $("select#final_{{ $aluno->id }}").hide();

                                    $("#detalhes_1_{{ $aluno->id }}").show();
                                    $("textarea#detalhes_{{ $aluno->id }}").hide();
                                    $("textarea#detalhes_{{ $aluno->id }}").attr('disabled', 1);
                                    $("textarea#detalhes_{{ $aluno->id }}").removeAttr('required');
                                    $("input#detalhes2_{{ $aluno->id }}").removeAttr('disabled');
                                }
                            }

                            </script>

                            @endsection
                            @endif @endforeach
                            @endforeach
                          </tbody>
                              </table>
                            </div>
                            <input type="hidden" class="user_id" value="{{Auth::user()->id}}" for="user_id" name="user_id">
                            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">

                             <div class="form-btn">
                                 <input class="btn btn-add" type="submit" value="Salvar">
                             </div>
                         </form>
                     </div>
                   </div>



                   <style media="screen">

                   th {
                     width: 100px;
                   }

                   th.space {
                     width: 2%;
                   }

                   th.final {
                     width: 25%;
                   }

                   th.tipo {
                     width: 30%;
                   }

                   </style>


@elseif($request_bimestre == 'MA')

@if(is_countable($nota) && is_countable($alunos) && count($nota) < count($alunos) * 4)

<div class="sregistros">
  <p class="mensage"> Para criar um registro de notas de recuperação final para essa turma, a media anual precisa ser gerada para todos os seus alunos, essa mensagem significa que pelo menos um aluno da turma não recebeu nota em algum bimestre, atualize seus registros em <strong>Atualizar Registro Existente</strong> e tente novamente. </p>
</div>

@else

<div class="table-responsive">
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                    <thead>
                      <tr>
                        <th> </th>
                        <th>Aluno</th>
                        <th>1ª Unidade</th>
                        <th>2ª Unidade</th>
                        <th>3ª Unidade</th>
                        <th>4ª Unidade</th>
                        <th>Média Anual</th>
                        <th>Nota da Rec. Final</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form method="POST" action="{{ route("admin.nota.new.mrecf") }}" enctype="multipart/form-data">
                          @csrf

                          <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
                          <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
                          <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
                          <input type="hidden" class="disciplina_id" value="{{ $request_disciplina }}" for="disciplina_id" name="disciplina_id">
                          <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
                          @foreach($alunos as $aluno)

                          <!-- cálculo Média Anual -->

                          @foreach($unidade1 as $n1) @if($aluno->id == $n1->aluno_id) <?php if(abs($n1->mb > $n1->rec)) { $nota1 = $n1->mb; } else { $nota1 = $n1->rec; } ?> @endif @endforeach
                          @foreach($unidade2 as $n2) @if($aluno->id == $n2->aluno_id) <?php if(abs($n2->mb > $n2->rec)) { $nota2 = $n2->mb; } else { $nota2 = $n2->rec; } ?> @endif @endforeach
                          @foreach($unidade3 as $n3) @if($aluno->id == $n3->aluno_id) <?php if(abs($n3->mb > $n3->rec)) { $nota3 = $n3->mb; } else { $nota3 = $n3->rec; } ?> @endif @endforeach
                          @foreach($unidade4 as $n4) @if($aluno->id == $n4->aluno_id) <?php if(abs($n4->mb > $n4->rec)) { $nota4 = $n4->mb; } else { $nota4 = $n4->rec; } ?> @endif @endforeach
                          <?php $div = 4; $total = ($nota1 + $nota2 + $nota3 + $nota4) / $div; ?>


                          <!--  -->

                            <td> </td>
                            <td> <input type="hidden" class="aluno" value="{{ $aluno->id }}" for="aluno_id" name="aluno_id_{{ $aluno->id }}[]"> {{ $aluno->nome_completo }}</td>
                            <td><input class="nota_{{ $aluno->id }}" id="u1_{{ $aluno->id }}" type="text" readonly @foreach($unidade1 as $u1) @if($aluno->id == $u1->aluno_id) @if($u1->mb > $u1->rec) value="{{ $u1->mb }}" @else value="{{ $u1->rec }}" @endif @endif @endforeach></td>
                            <td><input class="nota_{{ $aluno->id }}" id="u2_{{ $aluno->id }}" type="text" readonly @foreach($unidade2 as $u2) @if($aluno->id == $u2->aluno_id) @if($u2->mb > $u2->rec) value="{{ $u2->mb }}" @else value="{{ $u2->rec }}" @endif @endif @endforeach></td>
                            <td><input class="nota_{{ $aluno->id }}" id="u3_{{ $aluno->id }}" type="text" readonly @foreach($unidade3 as $u3) @if($aluno->id == $u3->aluno_id) @if($u3->mb > $u3->rec) value="{{ $u3->mb }}" @else value="{{ $u3->rec }}" @endif @endif @endforeach></td>
                            <td><input class="nota_{{ $aluno->id }}" id="u4_{{ $aluno->id }}" type="text" readonly @foreach($unidade4 as $u4) @if($aluno->id == $u4->aluno_id) @if($u4->mb > $u4->rec) value="{{ $u4->mb }}" @else value="{{ $u4->rec }}" @endif @endif @endforeach></td>
                            <td><input class="nota_{{ $aluno->id }}" id="ma_{{ $aluno->id }}" type="text" readonly value="<?php echo round($total, 2) ?>" ></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum_{{ $aluno->id }}()" id="mrecf_{{ $aluno->id }}" type="text" name="mrecf_{{ $aluno->id }}[]" <?php if(abs($total > 6)) { $read = 'readonly'; } else { $read = ''; } echo $read ?> ></td>
                            </tr>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


                      <style>

                      .nota_{{ $aluno->id }} {
                        color: #5f6162;
                        width: 60px;
                        height: 30px;
                        border: 0px solid white;
                        text-align: center;
                        font-weight: 700;
                      }

                      input#mrecf_{{ $aluno->id }}:read-only {
                      background-color: #0000000f; }

                      </style>

                      @section('scripts')
                      @parent

                      <script>

                      function onlynum_{{ $aluno->id }}() {
                      var mrecf = document.getElementById("mrecf_{{ $aluno->id }}");
                      var res = mrecf.value;

                        if (res != '') {
                          if (isNaN(res)) {

                            // Set input value empty
                            mrecf.value = "";

                            // Reset the form
                            fm.reset();
                            return false;
                          } else {
                            return true
                          }
                        }
                      }
                      </script>

                      <script>

                      $(".nota_{{ $aluno->id }}").on("change", function() {

                      var num = parseFloat($(this).val());
                      var cleanNum = num.toFixed(2);
                      $(this).val(cleanNum);
                      if(num/cleanNum < 1){
                        $('#error').text('Please enter only 2 decimal places, we have truncated extra points');
                        }
                      });


                      </script>

                      @endsection

                         @endforeach

                    </tbody>
                        </table>
                      </div>
                      <input type="hidden" class="user_id" value="{{Auth::user()->id}}" for="user_id" name="user_id">
                      <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">

                       <div class="form-btn">
                           <input class="btn btn-add" type="submit" value="Adicionar">
                       </div>
                   </form>
               </div>
             </div>

             @endif

@else

<div class="table-responsive">
                <table class=" table-sm table-bordered table-striped table-hover datatable">
                    <thead>
                      <tr>
                        <th> </th>
                        <th>Aluno</th>
                        <th>1ª AT</th>
                        <th>2ª AT</th>
                        <th>3ª AT</th>
                        <th>4ª AT</th>
                        <th>5ª AT</th>
                        <th>1ª Nota</th>
                        <th>2ª Nota</th>
                        <th>M. B.</th>
                        <th> Rec. {{ App\Models\Notum::BIMESTRE_SELECT[$request_bimestre] ?? '' }} </th>
                      </tr>
                    </thead>
                    <tbody>
                      <form method="POST" action="{{ route("admin.nota.store") }}" enctype="multipart/form-data">
                          @csrf

                          <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
                          <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
                          <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
                          <input type="hidden" class="disciplina_id" value="{{ $request_disciplina }}" for="disciplina_id" name="disciplina_id">
                          <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
                          @foreach($alunos as $aluno)

                            <td> </td>
                            <td> <input type="hidden" class="aluno" value="{{ $aluno->id }}" for="aluno_id" name="aluno_id_{{ $aluno->id }}[]"> {{ $aluno->nome_completo }}</td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum_{{ $aluno->id }}()" id="1at_{{ $aluno->id }}" type="text" name="at1_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum2_{{ $aluno->id }}()" id="2at_{{ $aluno->id }}" type="text" name="at2_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum3_{{ $aluno->id }}()" id="3at_{{ $aluno->id }}" type="text" name="at3_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum4_{{ $aluno->id }}()" id="4at_{{ $aluno->id }}" type="text" name="at4_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum5_{{ $aluno->id }}()" id="5at_{{ $aluno->id }}" type="text" name="at5_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" id="1nota_{{ $aluno->id }}" type="text" name="nota1_{{ $aluno->id }}[]" readonly></td> <!-- 11 -->
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum6_{{ $aluno->id }}()" id="2nota_{{ $aluno->id }}" type="text" name="nota2_{{ $aluno->id }}[]"></td>
                            <td><input class="nota_{{ $aluno->id }}" id="mb_{{ $aluno->id }}" type="text" name="mb_{{ $aluno->id }}[]" readonly></td>
                            <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum7_{{ $aluno->id }}()" id="rec_{{ $aluno->id }}" type="text" name="rec_{{ $aluno->id }}[]" readonly> </td>
                            </tr>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


                      <style>

                      .nota_{{ $aluno->id }} {
                        color: #5f6162;
                        width: 60px;
                        height: 30px;
                        border: 0px solid white;
                        text-align: center;
                        font-weight: 700;
                      }

                      input#rec_{{ $aluno->id }}:read-only {
                      background-color: #0000000f; }

                      </style>


                      @section('scripts')
                      @parent

                      <script>

                      $(".nota_{{ $aluno->id }}").on("change", function() {
                      var at1 = document.getElementById("1at_{{ $aluno->id }}").value;
                      var at2 = document.getElementById("2at_{{ $aluno->id }}").value;
                      var at3 = document.getElementById("3at_{{ $aluno->id }}").value;
                      var at4 = document.getElementById("4at_{{ $aluno->id }}").value;
                      var at5 = document.getElementById("5at_{{ $aluno->id }}").value;
                      var nota2 = document.getElementById("2nota_{{ $aluno->id }}").value;

                      if ((( (Number(at1) + Number(at2) + Number(at3) + Number(at4) + Number(at5)) / Number(5) + Number(nota2)) / Number(2) ) > 5.99) {
                      $('#rec_{{ $aluno->id }}').attr('readonly', 1);
                      } else {
                      $('#rec_{{ $aluno->id }}').removeAttr('readonly');
                      }

                      var num = parseFloat($(this).val());
                      var cleanNum = num.toFixed(2);
                      $(this).val(cleanNum);
                      if(num/cleanNum < 1){
                        $('#error').text('Please enter only 2 decimal places, we have truncated extra points');
                        }
                      });

                      </script>

                      <script>

                      $("#1at_{{ $aluno->id }}").keyup(calc);
                      $("#2at_{{ $aluno->id }}").keyup(calc);
                      $("#3at_{{ $aluno->id }}").keyup(calc);
                      $("#4at_{{ $aluno->id }}").keyup(calc);
                      $("#5at_{{ $aluno->id }}").keyup(calc);
                      $("#1nota_{{ $aluno->id }}").keyup(calc);
                      $("#2nota_{{ $aluno->id }}").keyup(calc);

                      function calc() {

                        $('#1nota_{{ $aluno->id }}').val(
                            (parseFloat($('#1at_{{ $aluno->id }}').val()) + parseFloat($("#2at_{{ $aluno->id }}").val()) + parseFloat($("#3at_{{ $aluno->id }}").val())
                            + parseFloat($("#4at_{{ $aluno->id }}").val()) + parseFloat($("#5at_{{ $aluno->id }}").val())) / parseFloat("5")
                      )

                      $('#mb_{{ $aluno->id }}').val(
                          (parseFloat($('#1nota_{{ $aluno->id }}').val()) + parseFloat($("#2nota_{{ $aluno->id }}").val())) / parseFloat("2")
                      )



                      }

                      </script>


                      <script>

                      function onlynum_{{ $aluno->id }}() {
                      var at1 = document.getElementById("1at_{{ $aluno->id }}");
                      var res = at1.value;

                        if (res != '') {
                          if (isNaN(res)) {

                            // Set input value empty
                            at1.value = "";

                            // Reset the form
                            fm.reset();
                            return false;
                          } else {
                            return true
                          }
                        }
                      }

                      function onlynum2_{{ $aluno->id }}() {
                        var at2 = document.getElementById("2at_{{ $aluno->id }}");
                        var res = at2.value;

                          if (res != '') {
                            if (isNaN(res)) {

                              // Set input value empty
                              at2.value = "";

                              // Reset the form
                              fm.reset();
                              return false;
                            } else {
                              return true
                            }
                          }
                        }

                        function onlynum3_{{ $aluno->id }}() {
                          var at3 = document.getElementById("3at_{{ $aluno->id }}");
                          var res = at3.value;

                            if (res != '') {
                              if (isNaN(res)) {

                                // Set input value empty
                                at3.value = "";

                                // Reset the form
                                fm.reset();
                                return false;
                              } else {
                                return true
                              }
                            }
                          }

                          function onlynum4_{{ $aluno->id }}() {
                            var at4 = document.getElementById("4at_{{ $aluno->id }}");
                            var res = at4.value;

                              if (res != '') {
                                if (isNaN(res)) {

                                  // Set input value empty
                                  at4.value = "";

                                  // Reset the form
                                  fm.reset();
                                  return false;
                                } else {
                                  return true
                                }
                              }
                            }

                            function onlynum5_{{ $aluno->id }}() {
                              var at5 = document.getElementById("5at_{{ $aluno->id }}");
                              var res = at5.value;

                                if (res != '') {
                                  if (isNaN(res)) {

                                    // Set input value empty
                                    at5.value = "";

                                    // Reset the form
                                    fm.reset();
                                    return false;
                                  } else {
                                    return true
                                  }
                                }
                              }

                              function onlynum6_{{ $aluno->id }}() {
                                var at6 = document.getElementById("2nota_{{ $aluno->id }}");
                                var res = at6.value;

                                  if (res != '') {
                                    if (isNaN(res)) {

                                      // Set input value empty
                                      at6.value = "";

                                      // Reset the form
                                      fm.reset();
                                      return false;
                                    } else {
                                      return true
                                    }
                                  }
                                }

                                function onlynum7_{{ $aluno->id }}() {
                                  var at7 = document.getElementById("rec_{{ $aluno->id }}");
                                  var res = at7.value;

                                    if (res != '') {
                                      if (isNaN(res)) {

                                        // Set input value empty
                                        at7.value = "";

                                        // Reset the form
                                        fm.reset();
                                        return false;
                                      } else {
                                        return true
                                      }
                                    }
                                  }

                      </script>
                      @endsection


                           @endforeach

                    </tbody>
                        </table>
                      </div>
                      <input type="hidden" class="user_id" value="{{Auth::user()->id}}" for="user_id" name="user_id">
                      <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">

                       <div class="form-btn">
                           <input class="btn btn-add" type="submit" value="Adicionar">
                       </div>
                   </form>
               </div>
             </div>
             @endif
             @endif

@endif
<div class="form-group">
<a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
{{ trans('global.back_to_list') }}
</a>
</div>
</div>
<link rel="stylesheet" href="{{ url('css/style.css') }}">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<style media="screen">

@media (min-width: 320px) and (max-width: 1023px) {
  .container-fluid[data-ativo='close'] {
      width: 100% !important;
      margin-right: auto;
      margin-left: -10px;
      margin-top: 9rem;
      transition: all 0.5s ease;
  }

  .container-fluid[data-ativo='open'] {
      width: 100% !important;
      margin-right: auto;
      margin-left: -10px !important;
      margin-top: 9rem;
      transition: all 0.5s ease;
  }
}

  @media (min-width: 1280px) {
    .container-fluid[data-ativo='close'] {
        width: 95% !important;
        margin-right: auto;
        margin-left: -10px;
        margin-top: 9rem;
        transition: all 0.5s ease;
    }
    .container-fluid[data-ativo='open'] {
        width: 95% !important;
        margin-right: auto;
        margin-left: -10px !important;
        margin-top: 9rem;
        transition: all 0.5s ease;
    }
  }


p.mensage {
    padding-top: 10px;
}

.sregistros {
    position: relative;
    width: 100%;
    height: 60px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    margin-bottom: 1.5rem;
    left: 0;
    right: 0;
}

thead {
    background-color: #ffffff;
}

.table-sm td, .table-sm th {
    padding: 1rem;
    padding-right: 2rem;
}

.form-btn {
    margin-top: 2rem;
    position: absolute;
    right: 10px;
}

</style>

 @endsection
