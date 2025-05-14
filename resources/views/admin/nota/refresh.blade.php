@extends('layouts.admin')
@section('content')

@foreach($turma as $turma) @endforeach
@if( $turma->nivel_da_turma == 'Ensino Infantil')

    <input type="hidden" class="escola_id" value="{{ $request_escola }}" for="escola_id" name="escola_id">
    <input type="hidden" class="turma_id" value="{{ $request_turma }}" for="turma_id" name="turma_id">
    <input type="hidden" class="ano" value="{{ $request_ano }}" for="ano" name="ano">
    <input type="hidden" class="bimestre" value="{{ $request_bimestre }}" for="bimestre" name="bimestre">
    <div class="table-responsive">

      <div class="form-aluno">
          <label class="required" for="aluno_id"> Selecione um aluno para ver seu registro correspondente. </label>
          <select class="form-control selectd" name="aluno_id" id="aluno_id" onchange="location = this.value;" required>
            <option value="">Selecione por favor</option>
              @foreach($alunos as $aluno)
                  <option value="{{ route('admin.nota.refresh-inf') }}?aluno={{$aluno->id}}&bimestre={{$request_bimestre}}&escola={{$request_escola}}&turma={{$request_turma}}&ano={{$request_ano}}"><a href=""> {{ $aluno->nome_completo }} </a></option>
              @endforeach
          </select>
          </div>

          </div>
<style media="screen">

input.btn.btn-next {
    color: #fff;
    background-color: #768192;
    border-color: #768192;
}

.form-aluno {
    margin-left: auto;
    padding-left: 0;
    margin-right: auto;
    width: 600px;
}

</style>

@else

<div class="card-body infos">
  @foreach($escola as $escola)
 <strong> Escola: </strong> <td> {{ $escola->name }} </td>
  @endforeach
 <br>
 <strong> Turma: </strong> <td> {{ $turma->serie }} {{ $turma->identificacao }} </td>
 <br>
  @foreach($disciplina as $disciplina)
 <strong> Disciplina: </strong> <td> {{ $disciplina->nome_da_materia }} </td>
  @endforeach
 <br>
 <strong> Bimestre: </strong> <td> {{ App\Models\Notum::BIMESTRE_SELECT[$request_bimestre] ?? '' }} </td>
</div>
      <div class="card-body">
              <div class="table-responsive">
                @if(is_countable($notum) && count($notum) == 0)
                <div class="sregistros">
                  <p class="mensage"> Não há registros de notas na escola selecionada, para a turma selecionada, na disciplina, ano e bimestre selecionado, verifique se houve algum erro de preenchimento e tente novamente. </p>
                </div>
                @else

  @if($request_bimestre == 'NRF')

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
                        <form method="POST" action="{{ route("admin.nota.up.mrecf") }}" enctype="multipart/form-data">
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
                              <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum_{{ $aluno->id }}()" id="mrecf_{{ $aluno->id }}" type="text" name="mrecf_{{ $aluno->id }}[]" @foreach($mrecf as $m) @if($aluno->id == $m->aluno_id)  value="{{ $m->mrecf }}" @endif @endforeach <?php if(abs($total > 6)) { $read = 'readonly'; } else { $read = ''; } echo $read ?> ></td>
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


  @else
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
@foreach($nota as $nota) @endforeach
<form method="POST" action="{{ route("admin.nota.update", [$nota]) }}" enctype="multipart/form-data">
      @method('PUT')
      @csrf

      @foreach($alunos as $aluno)

        <td> </td>
        <td> <input type="hidden" class="aluno" value="{{ $aluno->id }}" for="aluno_id" name="aluno_id_{{ $aluno->id }}[]"> {{ $aluno->nome_completo }}</td>
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum_{{ $aluno->id }}()" id="1at_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->at1 }}" @endif  @endforeach name="at1_{{ $aluno->id }}[]"></td> <!-- 2 -->
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum2_{{ $aluno->id }}()" id="2at_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->at2 }}" @endif @endforeach  name="at2_{{ $aluno->id }}[]"></td> <!-- 3 -->
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum3_{{ $aluno->id }}()" id="3at_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->at3 }}" @endif @endforeach  name="at3_{{ $aluno->id }}[]"></td> <!-- 5 -->
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum4_{{ $aluno->id }}()"  id="4at_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->at4 }}" @endif @endforeach  name="at4_{{ $aluno->id }}[]"></td> <!-- 7 -->
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum5_{{ $aluno->id }}()" id="5at_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->at5 }}" @endif @endforeach  name="at5_{{ $aluno->id }}[]"></td> <!-- 9 -->
        <td><input class="nota_{{ $aluno->id }}" id="1nota_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->nota1 }}" @endif @endforeach  name="nota1_{{ $aluno->id }}[]" readonly></td> <!-- 11 -->
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum6_{{ $aluno->id }}()"  id="2nota_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->nota2 }}" @endif @endforeach  name="nota2_{{ $aluno->id }}[]"></td> <!-- 12 -->
        <td><input class="nota_{{ $aluno->id }}" id="mb_{{ $aluno->id }}" type="text" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->mb }}" @endif @endforeach  name="mb_{{ $aluno->id }}[]" readonly></td>
        <td><input class="nota_{{ $aluno->id }}" oninput="return onlynum7_{{ $aluno->id }}()" id="rec_{{ $aluno->id }}" name="rec_{{ $aluno->id }}[]" @foreach($notum as $n) @if($aluno->id == $n->aluno_id) value="{{ $n->rec }}" @if( $n->mb >= 5.9 ) readonly @endif @endif @endforeach> </td>
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
      <div class="form-btn">
          <input class="btn btn-add" type="submit" value="Salvar">
      </div>
  @endif
  @endif
    </form>

</div>
      <div class="form-group">
          <a class="btn btn-default" href="{{ route('admin.nota.index') }}">
              {{ trans('global.back_to_list') }}
          </a>
      </div>

@endif

<link rel="stylesheet" href="{{ url('css/style.css') }}">

<style>

.infos {
    position: relative;
    color: white;
    margin-top: -120px;
}

.table-responsive>.table-bordered {
    border: 0;
    margin-top: 0rem;
    position: relative;
}

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

  thead {
      background-color: #ffffff;
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


.table-sm td, .table-sm th {
    padding: 1rem;
    padding-right: 2rem;
}

.form-btn {
    padding: 2rem;
    position: absolute;
    right: 10px;
}

.form-group {
    padding: 2rem;
    position: absolute;
    left: 10px;
}

</style>


@endsection
