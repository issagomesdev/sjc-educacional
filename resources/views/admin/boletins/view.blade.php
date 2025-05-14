@extends('layouts.admin')
@section('content')

<div class="canvas_div_pdf">

<div class="card-body-x">
<table class=" table-log table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
        <th> @foreach($escola as $escola) {{ $escola->name }} @endforeach </th>
        </tr>
    </thead>
</table>
</div>

<div class="card-body-y">
<table class=" table-log table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
        <th> @foreach($alunos as $aluno) {{ $aluno->nome_completo }} @endforeach </th>
        <th> @foreach($turma as $turma) {{  $turma->serie }} {{ $turma->identificacao }} - {{ $turma->nivel_da_turma }} @endforeach </th>
        <th> @foreach($ano as $ano) {{ $ano->ano }} @endforeach </th>
        </tr>
    </thead>
</table>
</div>

<div class="card-body">
</div>

<div class="card-body">
    <p>
<table class="table-sm table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
        <th width="40%"> COMPONENTES CURRICULARES </th>
        <th> 1ª Unidade </th>
        <th> 2ª Unidade </th>
        <th> Rec. da 1ª Unidade </th>
        <th> Rec. da 2ª Unidade </th>
        <th> 3ª Unidade </th>
        <th> 4ª Unidade </th>
        <th> Rec. da 3ª Unidade </th>
        <th> Rec. da 4ª Unidade </th>
        <th> Média Anual </th>
        <th> Nota da Rec. Final </th>
        <th> Média Final </th>
        <th> Total de Aulas </th>
        <th> Nº de Faltas </th>
        <th> % de presença </th>
        </tr>
    </thead>
<tbody>
@foreach($disciplina as $disciplina)
@if($disciplina->nivel_de_ensino == $turma->nivel_da_turma)

<!-- cálculos php -->

@foreach($unidade1 as $n1) @if($disciplina->id == $n1->disciplina_id) <?php if(abs($n1->mb > $n1->rec)) { $nota1 = $n1->mb; } else { $nota1 = $n1->rec; } ?> @endif @endforeach
@foreach($unidade2 as $n2) @if($disciplina->id == $n2->disciplina_id) <?php if(abs($n2->mb > $n2->rec)) { $nota2 = $n2->mb; } else { $nota2 = $n2->rec; } ?> @endif @endforeach
@foreach($unidade3 as $n3) @if($disciplina->id == $n3->disciplina_id) <?php if(abs($n3->mb > $n3->rec)) { $nota3 = $n3->mb; } else { $nota3 = $n3->rec; } ?> @endif @endforeach
@foreach($unidade4 as $n4) @if($disciplina->id == $n4->disciplina_id) <?php if(abs($n4->mb > $n4->rec)) { $nota4 = $n4->mb; } else { $nota4 = $n4->rec; } $div = 4; $total = ($nota1 + $nota2 + $nota3 + $nota4) / $div; ?> @endif @endforeach
@foreach($mrecf as $recf) @if($disciplina->id == $recf->disciplina_id) <?php if(abs($total > $recf->mrecf)) { $final[] = $total; } else { $final[] = $recf->mrecf; } ?> @endif @endforeach
@foreach($mrecf as $recf) @if($disciplina->id == $recf->disciplina_id) <?php if(abs($total > $recf->mrecf)) { $nota_final = $total; } else { $nota_final = $recf->mrecf; } ?> @endif @endforeach
<?php $t_aulas = 0; ?> @foreach($total_aulas as $total_aula) @if($disciplina->id == $total_aula->disciplina_id)  <?php $t_aulas++ ?>  @endif @endforeach
<?php $pres = 0; ?> @foreach($presences as $presence) @if($disciplina->id == $presence->disciplina_id)  <?php $pres++ ?>  @endif @endforeach
<?php if ($t_aulas == 0) { $porcent = 100; } else { $porcent = $pres/$t_aulas * 100; } ?>
<?php if ($porcent >= 70) $resultado[] = 1; else $resultado[] = 2; ?>

<!--  -->

<tr>
<td> {{ $disciplina->nome_da_materia }} </td>
<td> @foreach($u1 as $no1) @if($disciplina->id == $no1->disciplina_id) {{ $no1->mb ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u2 as $no2) @if($disciplina->id == $no2->disciplina_id) {{ $no2->mb ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u1 as $rec1) @if($disciplina->id == $rec1->disciplina_id) {{ $rec1->rec ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u2 as $rec2) @if($disciplina->id == $rec2->disciplina_id) {{ $rec2->rec ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u3 as $no3) @if($disciplina->id == $no3->disciplina_id) {{ $no3->mb ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u4 as $no4) @if($disciplina->id == $no4->disciplina_id) {{ $no4->mb ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u3 as $rec3) @if($disciplina->id == $rec3->disciplina_id) {{ $rec3->rec ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u4 as $rec4) @if($disciplina->id == $rec4->disciplina_id) {{ $rec4->rec ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($u4 as $m) @if($disciplina->id == $m->disciplina_id)  <?php echo round($total, 2) ?> @endif @endforeach </td>
<td> @foreach($mrecf as $recf) @if($disciplina->id == $recf->disciplina_id) {{ $recf->mrecf ?? '0.00' }} @endif @endforeach </td>
<td> @foreach($mrecf as $recf) @if($disciplina->id == $recf->disciplina_id)  <?php echo round($nota_final, 2) ?> @endif @endforeach </td>
<td> <?php echo $t_aulas; ?> </td>
<td> <?php $number = 0; ?> @foreach($faltas as $falta) @if($disciplina->id == $falta->disciplina_id)  <?php $number++ ?>  @endif @endforeach {{ $number }} </td>
<td> <?php echo round($porcent) ?>% </td>

</tr>
@endif
@endforeach
</tbody>
</table>
</div>



<div class="card-body-s">
<table class=" table-log table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
          <th> Resultado Final: @if($condition == 0) @else @if($resultadofinal == 0) Aprovado @elseif($resultadofinal <= 3) Em Progressão @elseif($resultadofinal > 3) Não Aprovado @endif @endif </th>
        </tr>
    </thead>
</table>
</div>
</p>
</div>

<div class="pdf">

<button onclick="getPDF()" class="btn btn-pdf" id="downloadbtn"><b> Baixar Boletim </b></button>

</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

@endsection
@section('styles')

<style media="screen">


.pdf {
    margin-bottom: 1rem;
}


table.table-log.table-bordered.table-striped.table-hover.datatable {
  width: 100% !important;
  height: 45px;
}

span {
    font-weight: 400;
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 0.1rem;
    padding-top: 2px;
    padding-bottom: 0.2rem;
    overflow-x: auto;
}

.card-body-s {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 0.2rem;
    margin-bottom: 1rem;
}

table.table-log.table-bordered.table-striped.table-hover.datatable {
    background-color: #ffffff;
}

table.table-sm.table-bordered.table-striped.table-hover.datatable {
    background-color: #ffffff;
}

.table-bordered, .table-bordered td, .table-bordered th {
    border: 0px solid;
    border-color: #dfdfdf;
}

.card-body-y {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 2px;
    text-align: center;
}

.card-body-x {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 2px;
    padding-bottom: 10px;
    text-align: center;
}

button#downloadbtn {
    color: #9fa1a2;
    background-color: #f2f2f300;
    border-color: #00000042;
    box-shadow: -3px 2px 1px 0px #00000052;
}

p {
    margin-top: 0;
    margin-bottom: 0rem;
}

.card-body {
    flex: 1 1 auto;
    padding: 0px 0px 0px 0px !important;
}

/* * container-fluid * */

@media (min-width: 320px) and (max-width: 425px){
  .container-fluid[data-ativo='close'] {
      width: 95% !important;
      margin-right: auto;
      margin-left: 0px !important;
      margin-top: 9rem;
      transition: all 0.5s ease;
  }
}

@media (min-width: 768px) and (max-width: 768px){

  .container-fluid[data-ativo='close'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: 0px !important;
    margin-top: 9rem;
    transition: all 0.5s ease;
}

}

@media (min-width: 1024px) and (max-width: 1024px) {
.container-fluid[data-ativo='close'] {
    width: 90% !important;
    margin-right: auto;
    margin-left: 0 !important;
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

@media (min-width: 1440px) {
.container-fluid[data-ativo='close'] {
    width: 100% !important;
    margin-right: auto;
    margin-left: 0 !important;
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

</style>

@endsection
@section('scripts')
@parent
<script type="text/javascript">

function getPDF(){

  var HTML_Width = $(".canvas_div_pdf").width();
  var HTML_Height = $(".canvas_div_pdf").height();
  var top_left_margin = 15;
  var PDF_Width = HTML_Width+(top_left_margin*2);
  var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
  var canvas_image_width = HTML_Width;
  var canvas_image_height = HTML_Height;

  var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


  html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
    canvas.getContext('2d');

    console.log(canvas.height+"  "+canvas.width);


    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
      pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


    for (var i = 1; i <= totalPDFPages; i++) {
      pdf.addPage(PDF_Width, PDF_Height);
      pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    }

      pdf.save("Boletin-{{ $aluno->nome_completo }}.pdf");
      });
};

</script>

@endsection
