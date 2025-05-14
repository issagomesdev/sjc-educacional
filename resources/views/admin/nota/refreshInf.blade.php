@extends('layouts.admin')
@section('content')

<div class="card-body">


  @foreach($alunos as $aluno)
 <strong> Aluno: </strong> <td> {{ $aluno->nome_completo }} </td>
  @endforeach
  <br>
  @foreach($escola as $escola)
 <strong> Escola: </strong> <td> {{ $escola->name }}</td>
  @endforeach
  <br>
  @foreach($turma as $turma)
 <strong> Turma: </strong> <td> {{ $turma->serie }} {{ $turma->identificacao }} </td>
  @endforeach
  <br>
 <strong> Bimestre: </strong> <td> {{ App\Models\Notum::BIMESTRE_SELECT[$request_bimestre] ?? '' }} </td>



</div>

  @foreach($notum as $notum)
<form method="POST" action="{{ route("admin.nota.up") }}" enctype="multipart/form-data">
    @csrf
<div class="table-responsive">
<input type="hidden" class="aluno_id" value="{{ $request_aluno }}" for="aluno_id" name="aluno_id">
<input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
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
{!! old('conhecendo_contexto', $notum->conhecendo_contexto) !!}</textarea>
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
{!! old('registro_conquistas', $notum->registro_conquistas) !!}</textarea>
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
<td> <input class="form-input" type="checkbox" name="01EO01_s1" id="01EO01_s1" value="1" @if($notum['01EO01_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO01_s2" id="01EO01_s2" value="1" @if($notum['01EO01_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO02PE)</strong> Perceber suas possibilidades e os limites de seu corpo nas brincadeiras e interações das quais participa no seu convívio social. </td>
<td> <input class="form-input" type="checkbox" name="01EO02_s1" id="01EO02_s1" value="1" @if($notum['01EO02_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO02_s2" id="01EO02_s2" value="1" @if($notum['01EO02_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO03PE)</strong> Interagir com crianças da mesma e de outras faixas etárias e com adultos, ao explorar espaços, materiais, objetos, brinquedos e brincadeiras. </td>
<td> <input class="form-input" type="checkbox" name="01EO03_s1" id="01EO03_s1" value="1" @if($notum['01EO03_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO03_s2" id="01EO03_s2" value="1" @if($notum['01EO03_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO04PE)</strong> Comunicar necessidades, desejos e emoções, utilizando gestos, balbucios, palavras. </td>
<td> <input class="form-input" type="checkbox" name="01EO04_s1" id="01EO04_s1" value="1" @if($notum['01EO04_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO04_s2" id="01EO04_s2" value="1" @if($notum['01EO04_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO05PE)</strong> Reconhecer as sensações do seu corpo em momentos de alimentação, higiene, brincadeira e descanso. </td>
<td> <input class="form-input" type="checkbox" name="01EO05_s1" id="01EO05_s1" value="1" @if($notum['01EO05_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO05_s2" id="01EO05_s2" value="1" @if($notum['01EO05_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO06PE)</strong> Interagir com outras crianças da mesma e de outras faixas etárias e com adultos adaptando-se ao convívio sociocultural, através de experiências cotidianas lúdicas. </td>
<td> <input class="form-input" type="checkbox" name="01EO06_s1" id="01EO06_s1" value="1" @if($notum['01EO06_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO06_s2" id="01EO06_s2" value="1" @if($notum['01EO06_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01EO07PE)</strong> Interagir com outras crianças da mesma e de outras faixas etárias e com adultos adaptando-se ao convívio sociocultural, através de experiências cotidianas lúdicas. </td>
<td> <input class="form-input" type="checkbox" name="01EO07_s1" id="01EO07_s1" value="1" @if($notum['01EO07_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01EO07_s2" id="01EO07_s2" value="1" @if($notum['01EO07_s2'] == 1) checked @endif> </td>
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
<td> <input class="form-input" type="checkbox" name="02EO01_s1" id="02EO01_s1" value="1" @if($notum['02EO01_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO01_s2" id="02EO01_s2" value="1" @if($notum['02EO01_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02EO02PE)</strong> Demonstrar imagem positiva de si e confiança para enfrentar dificuldades e desafios em diferentes contextos. </td>
<td> <input class="form-input" type="checkbox" name="02EO02_s1" id="02EO02_s1" value="1" @if($notum['02EO02_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO02_s2" id="02EO02_s2" value="1" @if($notum['02EO02_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02EO03PE)</strong> Comunicar-se com os colegas e os adultos, buscando compreendê-los e fazendo-se compreender. </td>
<td> <input class="form-input" type="checkbox" name="02EO03_s1" id="02EO03_s1" value="1" @if($notum['02EO03_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO03_s2" id="02EO03_s2" value="1" @if($notum['02EO03_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02EO04PE)</strong> Comunicar-se com os colegas e os adultos, buscando compreendê-los e fazendo-se compreender. </td>
<td> <input class="form-input" type="checkbox" name="02EO04_s1" id="02EO04_s1" value="1" @if($notum['02EO04_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO04_s2" id="02EO04_s2" value="1" @if($notum['02EO04_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02EO05PE)</strong> Perceber que as pessoas têm preferências e características físicas diferentes (altura, cor de olhos, cor da pele, tipos de cabelos, etc.), respeitando essas diferenças. </td>
<td> <input class="form-input" type="checkbox" name="02EO05_s1" id="02EO05_s1" value="1" @if($notum['02EO05_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO05_s2" id="02EO05_s2" value="1" @if($notum['02EO05_s2'] == 1) checked @endif> </td>
</tr>
<td> <strong>(EI02EO06PE)</strong> Fazer uso de normas sociais, participando de brincadeiras, pertencentes à cultura local. </td>
<td> <input class="form-input" type="checkbox" name="02EO06_s1" id="02EO06_s1" value="1" @if($notum['02EO06_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO06_s2" id="02EO06_s2" value="1" @if($notum['02EO06_s2'] == 1) checked @endif> </td>
</tr>
<td> <strong>(EI02EO07PE)</strong> Utilizar suas habilidades comunicativas, ampliando a compreensão das mensagens dos colegas para resolução de conflitos. </td>
<td> <input class="form-input" type="checkbox" name="02EO07_s1" id="02EO07_s1" value="1" @if($notum['02EO07_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02EO07_s2" id="02EO07_s2" value="1" @if($notum['02EO07_s2'] == 1) checked @endif> </td>
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
<td> <input class="form-input" type="checkbox" name="01ET01_s1" id="01ET01_s1" value="1" @if($notum['01ET01_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET01_s2" id="01ET01_s2" value="1" @if($notum['01ET01_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET02PE)</strong> Explorar relações de causa e efeito (transbordar, tingir, misturar, mover e remover, etc.) na interação com o mundo físico. </td>
<td> <input class="form-input" type="checkbox" name="01ET02_s1" id="01ET02_s1" value="1" @if($notum['01ET02_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET02_s2" id="01ET02_s2" value="1" @if($notum['01ET02_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET03PE)</strong> Explorar o ambiente pela ação e observação, manipulando, experimentando e fazendo descobertas, identificando nos seres vivos, tamanho, cheiro, som, cores, e percebendo o movimento de pessoas e etc. </td>
<td> <input class="form-input" type="checkbox" name="01ET03_s1" id="01ET03_s1" value="1" @if($notum['01ET03_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET03_s2" id="01ET03_s2" value="1" @if($notum['01ET03_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET04PE)</strong> Manipular, experimentar, arrumar e explorar diferentes espaços com diversos desafios. por meio de experiências de deslocamentos de si e dos objetos. </td>
<td> <input class="form-input" type="checkbox" name="01ET04_s1" id="01ET04_s1" value="1" @if($notum['01ET04_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET04_s2" id="01ET04_s2" value="1" @if($notum['01ET04_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET05PE)</strong> Manipular materiais diversos e variados para perceber as diferenças e semelhanças entre eles. </td>
<td> <input class="form-input" type="checkbox" name="01ET05_s1" id="01ET05_s1" value="1" @if($notum['01ET05_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET05_s2" id="01ET05_s2" value="1" @if($notum['01ET05_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET06PE)</strong> Vivenciar diferentes ritmos, velocidades e fluxos nas interações e brincadeiras (em danças, balanços, escorregos , etc.). </td>
<td> <input class="form-input" type="checkbox" name="01ET06_s1" id="01ET06_s1" value="1" @if($notum['01ET06_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET06_s2" id="01ET06_s2" value="1" @if($notum['01ET06_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET07PE)</strong> Vivenciar brincadeiras que despertem interesse e curiosidade por fenômenos da natureza (chuva, seca, vento, correnteza, etc.). </td>
<td> <input class="form-input" type="checkbox" name="01ET07_s1" id="01ET07_s1" value="1" @if($notum['01ET07_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET07_s2" id="01ET07_s2" value="1" @if($notum['01ET07_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET08PE)</strong> Experimentar livremente as diversas formas de deslocamento no espaço |(correr pular, andar, engatinhar, rolar, subir, descer entre outros). </td>
<td> <input class="form-input" type="checkbox" name="01ET08_s1" id="01ET08_s1" value="1" @if($notum['01ET08_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET08_s2" id="01ET08_s2" value="1" @if($notum['01ET08_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI01ET09PE)</strong> Explorar o ambiente natural externo da unidade por meio de passeios. </td>
<td> <input class="form-input" type="checkbox" name="01ET09_s1" id="01ET09_s1" value="1" @if($notum['01ET09_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="01ET09_s2" id="01ET09_s2" value="1" @if($notum['01ET09_s2'] == 1) checked @endif> </td>
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
<td> <input class="form-input" type="checkbox" name="02ET01_s1" id="02ET01_s1" value="1" @if($notum['02ET01_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET01_s2" id="02ET01_s2" value="1" @if($notum['02ET01_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET02PE)</strong> Observar, relatar e descrever incidentes do cotidiano e fenômenos naturais (luz solar, vento, chuva, etc.). </td>
<td> <input class="form-input" type="checkbox" name="02ET02_s1" id="02ET02_s1" value="1" @if($notum['02ET02_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET02_s2" id="02ET02_s2" value="1" @if($notum['02ET02_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET03PE)</strong> Compartilhar e explorar, com outras crianças, situações de cuidado de pantas e animais nos espaços da instituição e fora dela, despertando para consciência ambiental e a formação cidadã. </td>
<td> <input class="form-input" type="checkbox" name="02ET03_s1" id="02ET03_s1" value="1" @if($notum['02ET03_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET03_s2" id="02ET03_s2" value="1" @if($notum['02ET03_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET04PE)</strong> Identificar relações espaciais (dentro e fora, em cima, embaixo, acima, abaixo, longe e perto, entre e do lado) e temporais (antes, durante e depois), em diversas ações do cotidiano. </td>
<td> <input class="form-input" type="checkbox" name="02ET04_s1" id="02ET04_s1" value="1" @if($notum['02ET04_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET04_s2" id="02ET04_s2" value="1" @if($notum['02ET04_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET05PE)</strong> Classificar objetos, a partir de determinados atributos (tamanho, massa, cor, forma, espessura, etc.), utilizando materiais concretos. </td>
<td> <input class="form-input" type="checkbox" name="02ET05_s1" id="02ET05_s1" value="1" @if($notum['02ET05_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET05_s2" id="02ET05_s2" value="1" @if($notum['02ET05_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET06PE)</strong> Utilizar conceitos básicos (agora, depois, depressa, devagar), nas situações as do cotidiano. </td>
<td> <input class="form-input" type="checkbox" name="02ET06_s1" id="02ET06_s1" value="1" @if($notum['02ET06_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET06_s2" id="02ET06_s2" value="1" @if($notum['02ET06_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET07PE)</strong> Contar oralmente objetos, pessoas, livros, etc., nas situações diversas e em diversos significativos. </td>
<td> <input class="form-input" type="checkbox" name="02ET07_s1" id="02ET07_s1" value="1" @if($notum['02ET07_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET07_s2" id="02ET07_s2" value="1" @if($notum['02ET07_s2'] == 1) checked @endif> </td>
</tr>
<tr>
<td> <strong>(EI02ET08PE)</strong> Registrar quantidades em diferentes formas (números, gráficos, objetos, etc.) nas situações diversas e em contextos significativos. </td>
<td> <input class="form-input" type="checkbox" name="02ET08_s1" id="02ET08_s1" value="1" @if($notum['02ET08_s1'] == 1) checked @endif> </td>
<td> <input class="form-input" type="checkbox" name="02ET08_s2" id="02ET08_s2" value="1" @if($notum['02ET08_s2'] == 1) checked @endif> </td>
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
{!! old('parecer_descritivo_s1', $notum->parecer_descritivo_s1) !!}</textarea>
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
{!! old('parecer_descritivo_s2', $notum->parecer_descritivo_s2) !!}</textarea>
</td>
</fieldset>
</tr>
</tbody>
</table>
</div>
@endforeach
@if(is_countable($notum) && count($notum) == 0)
<div class="sregistros">
  <p class="mensage"> Não há registros de notas para o aluno selecionado da turma selecionada, na escola selecionada, no bimestre selecionado e ano selecionado, verifique se houve algum erro de preenchimento e tente novamente. </p>
</div>
@else
<div class="form-btn">
<input class="btn btn-add" type="submit" value="Adicionar">
</div>
@endif
</form>
<div class="form-group">
<a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
{{ trans('global.back_to_list') }}
</a>
</div>
</div>

<link rel="stylesheet" href="{{ url('css/style.css') }}">

<style>

p.mensage {
    padding-top: 15px;
}

.sregistros {
    position: relative;
    width: 96%;
    height: 60px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    margin-bottom: 1.5rem;
    left: 0;
    background-color: #00000012;
    right: 0;
}

.table-sm td, .table-sm th {
    padding: 1rem;
    padding-right: 2rem;
}

.form-btn {
    margin-top: 2rem;
    margin-left: 55rem;
    margin-bottom: 1.5rem;
}

</style>


@endsection
