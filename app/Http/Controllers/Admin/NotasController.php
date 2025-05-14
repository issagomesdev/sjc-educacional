<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNotumRequest;
use App\Http\Requests\StoreNotumRequest;
use App\Http\Requests\UpdateNotumRequest;
use App\Models\AbrirEEncerrarAnoLetivo;
use Illuminate\Support\Arr;
use App\Models\Cadastro;
use App\Models\Materium;
use App\Models\Notum;
use App\Models\NotumInf;
use App\Models\PresencaEletiva;
use App\Models\ResultadoFinal;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nota = Notum::with(['disciplina', 'escola', 'turma', 'alunos', 'team', 'assinatura'])->get();

        $escola = Team::where('tipo_de_instituicao_id', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $teams = Team::get();

        $turmas = Turma::get();

        $cadastros = Cadastro::get();

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $array_2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->where('situacao', 1)
        ->get();

        $anos_letivos_abertos = json_decode(json_encode($array_2), true);

        return view('admin.nota.index', compact('anos_letivos_abertos', 'anos_letivos', 'nota', 'escola', 'disciplinas', 'teams', 'turmas', 'cadastros'));
    }

    public function create(request $request)
    {
        abort_if(Gate::denies('notum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());
        $request_escola = $request->escola_id;
        $request_turma = $request->turma_id;
        $request_ano = $request->ano;
        $request_disciplina = $request->disciplina_id;
        $request_bimestre = $request->bimestre;

        $escola = Team::where('id', $request->escola_id)->get();

        $turma = Turma::where('id', $request->turma_id)->get();

        $ano = AbrirEEncerrarAnoLetivo::where('id', $request->ano)->get();

        $disciplina = Materium::where('id', $request->disciplina_id)->get();

        $alunos = Cadastro::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->get();

        $notum = Notum::where('escola_id', $request_escola)->where('turma_id', $request_turma)->where('disciplina_id', $request_disciplina)
        ->where('ano', $request_ano)->where('bimestre', $request_bimestre)->get();

        $nota = Notum::where('escola_id', $request_escola)->where('turma_id', $request_turma)->where('disciplina_id', $request_disciplina)
        ->where('ano', $request_ano)->get();

        $unidade1 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '1B')->get();

        $unidade2 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '2B')->get();

        $unidade3 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '3B')->get();

        $unidade4 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '4B')->get();

        $mrecf = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', 'MA')->get();

        $media = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->get();

        $total_aulas = PresencaEletiva::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turmas_id', $request_turma)->where('ano', $request_ano)->get();

        $presences = PresencaEletiva::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turmas_id', $request_turma)->where('ano', $request_ano)->where('selecione_falta', '!=' ,'FNJ')->get();

        $faltas = PresencaEletiva::where('selecione_falta', 'FNJ')->where('disciplina_id', $request->disciplina_id)->get();

        return view('admin.nota.create', compact('presences', 'total_aulas', 'faltas', 'nota', 'notum', 'media', 'unidade1', 'unidade2', 'unidade3', 'unidade4', 'mrecf', 'request_escola', 'request_turma', 'request_ano', 'request_disciplina', 'request_bimestre', 'escola', 'turma', 'ano', 'disciplina', 'alunos'));
    }

    public function newResultado(Request $request)
    {
      // dd($request->all());

      $array = array_filter(request()->all(), function ($key) {
            return strpos($key, 'aluno_id-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $alunos = array_values($array);

      $array2 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'tipo_aprovacao-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $tipo_aprovacao = array_values($array2);

      $array3 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'final-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $final = array_values($array3);

      $array4 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'detalhes-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $detalhes = array_values($array4);

      $array5 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'nota_final-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $nota_final = array_values($array5);

      $array6 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'presence-') === 0;
        }, ARRAY_FILTER_USE_KEY);

      $presence = array_values($array6);

      for ($i=0; $i < sizeof($alunos); $i++) {

        $resultado['ano'] = $request->ano;
        $resultado['escola_id'] = $request->escola_id;
        $resultado['turma_id'] = $request->turma_id;
        $resultado['disciplina_id'] = $request->disciplina_id;
        $resultado['nota_final'] = $nota_final[$i];
        $resultado['presence'] = $presence[$i];
        $resultado['aluno_id'] = $alunos[$i];
        $resultado['tipo_de_aprovacao'] = $tipo_aprovacao[$i];
        $resultado['resultado_final'] = $final[$i];
        $resultado['detalhes'] = $detalhes[$i];
        $resultado['team_id'] = $request->team_id;
        $resultado['assinatura_id'] = $request->user_id;
        ResultadoFinal::create($resultado);

      }


        return redirect()->route('admin.nota.index');
    }


    public function new(Request $request)
    {
      // dd($request->all());
      $nota = NotumInf::create($request->all());

        return redirect()->route('admin.nota.index');
    }

    public function up(Request $request)
    {

      // dd($request->all());
      $nota = NotumInf::where('aluno_id', $request->aluno_id)->where('bimestre', $request->bimestre)->first();
      $nota->update($request->all());

        return redirect()->route('admin.nota.index');
    }

    public function newMrecf(Request $request)
    {
      // dd($request->all());
      $array = array_filter(request()->all(), function ($key) {
            return strpos($key, 'mrecf_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $get = array_values($array);
        $new = collect($get)->pluck('0');
        $mrecf = Arr::collapse([$new]);

        $array2 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'aluno_id_') === 0;
          }, ARRAY_FILTER_USE_KEY);

          $get2 = array_values($array2);
          $new2 = collect($get2)->pluck('0');
          $alunos = Arr::collapse([$new2]);

          for ($i=0; $i < sizeof($alunos); $i++) {

            $notum['ano'] = $request->ano;
            $notum['escola_id'] = $request->escola_id;
            $notum['turma_id'] = $request->turma_id;
            $notum['bimestre'] = $request->bimestre;
            $notum['disciplina_id'] = $request->disciplina_id;
            $notum['aluno_id'] = $alunos[$i];
            $notum['mrecf'] = $mrecf[$i];
            $notum['team_id'] = $request->team_id;
            $notum['assinatura_id'] = $request->user_id;
            Notum::create($notum);

          }


        return redirect()->route('admin.nota.index');
    }

    public function upMrecf(Request $request)
    {

       // dd($request->all());
      $array = array_filter(request()->all(), function ($key) {
            return strpos($key, 'mrecf_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $get = array_values($array);
        $new = collect($get)->pluck('0');
        $mrecf = Arr::collapse([$new]);

        $array2 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'aluno_id_') === 0;
          }, ARRAY_FILTER_USE_KEY);

          $get2 = array_values($array2);
          $new2 = collect($get2)->pluck('0');
          $alunos = Arr::collapse([$new2]);

          for ($i=0; $i < sizeof($alunos); $i++) {

            $notum['ano'] = $request->ano;
            $notum['escola_id'] = $request->escola_id;
            $notum['turma_id'] = $request->turma_id;
            $notum['bimestre'] = $request->bimestre;
            $notum['disciplina_id'] = $request->disciplina_id;
            $notum['aluno_id'] = $alunos[$i];
            $notum['mrecf'] = $mrecf[$i];
            $notum['team_id'] = $request->team_id;
            $notum['assinatura_id'] = $request->user_id;
            // $notum::update();

          }

        return redirect()->route('admin.nota.index');
    }

    public function store(Request $request)
    {

  // dd($request -> all());

$array1 = array_filter(request()->all(), function ($key) {
      return strpos($key, 'aluno_') === 0;
  }, ARRAY_FILTER_USE_KEY); $get1 = array_values($array1); $new1 = collect($get1)->pluck('0'); $alunos = Arr::collapse([$new1]);

$array2 = array_filter(request()->all(), function ($key) {
      return strpos($key, 'at1_') === 0;
  }, ARRAY_FILTER_USE_KEY); $get2 = array_values($array2); $new2 = collect($get2)->pluck('0'); $at1 = Arr::collapse([$new2]);


$array3 = array_filter(request()->all(), function ($key) {
      return strpos($key, 'at2_') === 0;
  }, ARRAY_FILTER_USE_KEY); $get3 = array_values($array3); $new3 = collect($get3)->pluck('0'); $at2 = Arr::collapse([$new3]);


$array4 = array_filter(request()->all(), function ($key) {
      return strpos($key, 'at3_') === 0;
  }, ARRAY_FILTER_USE_KEY); $get4 = array_values($array4); $new4 = collect($get4)->pluck('0'); $at3 = Arr::collapse([$new4]);


$array5 = array_filter(request()->all(), function ($key) {
        return strpos($key, 'at4_') === 0;
    }, ARRAY_FILTER_USE_KEY); $get5 = array_values($array5); $new5 = collect($get5)->pluck('0'); $at4 = Arr::collapse([$new5]);


$array6 = array_filter(request()->all(), function ($key) {
    return strpos($key, 'at5_') === 0;
  }, ARRAY_FILTER_USE_KEY); $get6 = array_values($array6); $new6 = collect($get6)->pluck('0'); $at5 = Arr::collapse([$new6]);

$array7 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'nota1_') === 0;
        }, ARRAY_FILTER_USE_KEY); $get7 = array_values($array7); $new7 = collect($get7)->pluck('0'); $nota1 = Arr::collapse([$new7]);

$array8 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'nota2_') === 0;
          }, ARRAY_FILTER_USE_KEY); $get8 = array_values($array8); $new8 = collect($get8)->pluck('0'); $nota2 = Arr::collapse([$new8]);

$array9 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'mb_') === 0;
          }, ARRAY_FILTER_USE_KEY); $get9 = array_values($array9); $new9 = collect($get9)->pluck('0'); $mb = Arr::collapse([$new9]);

$array10 = array_filter(request()->all(), function ($key) {
              return strpos($key, 'rec_') === 0;
          }, ARRAY_FILTER_USE_KEY); $get10 = array_values($array10); $new10 = collect($get10)->pluck('0'); $rec = Arr::collapse([$new10]);

      for ($i=0; $i < sizeof($alunos); $i++) {

        $notum['ano'] = $request->ano;
        $notum['escola_id'] = $request->escola_id;
        $notum['turma_id'] = $request->turma_id;
        $notum['bimestre'] = $request->bimestre;
        $notum['disciplina_id'] = $request->disciplina_id;
        $notum['aluno_id'] = $alunos[$i];
        $notum['at1'] = $at1[$i];
        $notum['at2'] = $at2[$i];
        $notum['at3'] = $at3[$i];
        $notum['at4'] = $at4[$i];
        $notum['at5'] = $at5[$i];
        $notum['nota1'] = $nota1[$i];
        $notum['nota2'] = $nota2[$i];
        $notum['mb'] = $mb[$i];
        $notum['rec'] = $rec[$i];
        $notum['team_id'] = $request->team_id;
        $notum['assinatura_id'] = $request->user_id;
        Notum::create($notum);

      }

        return redirect()->route('admin.nota.index');
    }

    public function refresh(request $request, Notum $notum)
    {
        abort_if(Gate::denies('notum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_escola = $request->escola_id;
        $request_turma = $request->turma_id;
        $request_ano = $request->ano;
        $request_disciplina = $request->disciplina_id;
        $request_bimestre = $request->bimestre;

        $escola = Team::where('id', $request->escola_id)->get();

        $turma = Turma::where('id', $request->turma_id)->get();

        $ano = AbrirEEncerrarAnoLetivo::where('id', $request->ano)->get();

        $disciplina = Materium::where('id', $request->disciplina_id)->get();

        $alunos = Cadastro::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->get();

        $nota = Notum::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->where('disciplina_id', $request->disciplina_id)
        ->where('ano', $request->ano)->where('bimestre', $request->bimestre)->get();

        $unidade1 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '1B')->get();

        $unidade2 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '2B')->get();

        $unidade3 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '3B')->get();

        $unidade4 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '4B')->get();

        $mrecf = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', 'NRF')->get();

        $media = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->get();

        $notum = Notum::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->where('disciplina_id', $request->disciplina_id)
        ->where('ano', $request->ano)->where('bimestre', $request->bimestre)->get();

      return view('admin.nota.refresh', compact('nota', 'notum', 'unidade1', 'unidade2', 'unidade3', 'unidade4', 'mrecf', 'request_escola', 'request_turma', 'request_ano', 'request_disciplina', 'request_bimestre', 'escola', 'turma', 'ano', 'disciplina', 'alunos'));
      }

    public function update(Request $request, Notum $notum)
    {
      // dd($request->all());

$array1 = array_filter(request()->all(), function ($key) {
return strpos($key, 'aluno_') === 0;
}, ARRAY_FILTER_USE_KEY); $alunos = array_values($array1);

$array2 = array_filter(request()->all(), function ($key) {
return strpos($key, 'at1_') === 0;
}, ARRAY_FILTER_USE_KEY); $at1 = array_values($array2);


$array3 = array_filter(request()->all(), function ($key) {
return strpos($key, 'at2_') === 0;
}, ARRAY_FILTER_USE_KEY); $at2 = array_values($array3);


$array4 = array_filter(request()->all(), function ($key) {
return strpos($key, 'at3_') === 0;
}, ARRAY_FILTER_USE_KEY); $at3 = array_values($array4);


$array5 = array_filter(request()->all(), function ($key) {
return strpos($key, 'at4_') === 0;
}, ARRAY_FILTER_USE_KEY); $at4 = array_values($array5);


$array6 = array_filter(request()->all(), function ($key) {
return strpos($key, 'at5_') === 0;
}, ARRAY_FILTER_USE_KEY); $at5 = array_values($array6);

$array7 = array_filter(request()->all(), function ($key) {
return strpos($key, 'nota1_') === 0;
}, ARRAY_FILTER_USE_KEY); $nota1 = array_values($array7);

$array8 = array_filter(request()->all(), function ($key) {
return strpos($key, 'nota2_') === 0;
}, ARRAY_FILTER_USE_KEY); $nota2 = array_values($array8);

$array9 = array_filter(request()->all(), function ($key) {
return strpos($key, 'mb_') === 0;
}, ARRAY_FILTER_USE_KEY); $mb = array_values($array9);

$array10 = array_filter(request()->all(), function ($key) {
return strpos($key, 'rec_') === 0;
}, ARRAY_FILTER_USE_KEY); $rec = array_values($array10);



      for ($i=0; $i < sizeof($alunos); $i++) {

        $notum = Notum::whereIn('aluno_id', $alunos)->get();
        $notum['at1'] = $at1[$i];
        $notum['at2'] = $at2[$i];
        $notum['at3'] = $at3[$i];
        $notum['at4'] = $at4[$i];
        $notum['at5'] = $at5[$i];
        $notum['nota1'] = $nota1[$i];
        $notum['nota2'] = $nota2[$i];
        $notum['mb'] = $mb[$i]; }

     for ($i=0; $i < sizeof($rec); $i++) { $notum['rec'] = $rec[$i]; }
        // $notum::update();


        return redirect()->route('admin.nota.index');
    }

    public function refreshInf(request $request, Notum $notum)
    {
        abort_if(Gate::denies('notum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());
        $request_aluno = $request->aluno;
        $request_bimestre = $request->bimestre;
        $request_escola = $request->escola;
        $request_turma = $request->turma;
        $request_ano = $request->ano;

        $alunos = Cadastro::where('id', $request_aluno)->get();

        $escola = Team::where('id', $request_escola)->get();

        $turma = Turma::where('id', $request_turma)->get();

        $ano = AbrirEEncerrarAnoLetivo::where('id', $request_ano)->get();

        $notum = NotumInf::where('aluno_id', $request_aluno)->where('bimestre', $request_bimestre)->where('ano', $request_ano)
        ->where('escola_id', $request_escola)->where('turma_id', $request_turma)->get();

      return view('admin.nota.refreshInf', compact('notum', 'request_aluno', 'request_escola', 'request_turma', 'request_ano', 'request_bimestre', 'request_bimestre', 'escola', 'turma', 'ano', 'alunos'));
      }

    public function view(request $request)
    {


      abort_if(Gate::denies('notum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $request_escola = $request->escola_id;
      $request_turma = $request->turma_id;
      $request_ano = $request->ano;
      $request_disciplina = $request->disciplina_id;
      $request_bimestre = $request->bimestre;

      $escola = Team::where('id', $request->escola_id)->get();

      $turma = Turma::where('id', $request->turma_id)->get();

      $ano = AbrirEEncerrarAnoLetivo::where('id', $request->ano)->get();

      $disciplina = Materium::where('id', $request->disciplina_id)->get();

      $alunos = Cadastro::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->get();

      $notum = Notum::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->where('disciplina_id', $request->disciplina_id)
      ->where('ano', $request->ano)->where('bimestre', $request->bimestre)->get();

      $unidade1 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
      ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '1B')->get();

      $unidade2 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
      ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '2B')->get();

      $unidade3 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
      ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '3B')->get();

      $unidade4 = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
      ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '4B')->get();

      $mrecf = Notum::where('escola_id', $request_escola)->where('disciplina_id', $request_disciplina)
      ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', 'NRF')->get();


      return view('admin.nota.view', compact('notum', 'unidade1', 'unidade2', 'unidade3', 'unidade4', 'mrecf', 'request_escola', 'request_turma', 'request_ano', 'request_disciplina', 'request_bimestre', 'escola', 'turma', 'ano', 'disciplina', 'alunos'));
    }

    public function viewInf(request $request)
    {

      abort_if(Gate::denies('notum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $request_aluno = $request->aluno;
      $request_bimestre = $request->bimestre;
      $request_escola = $request->escola;
      $request_turma = $request->turma;
      $request_ano = $request->ano;

      $alunos = Cadastro::where('id', $request_aluno)->get();

      $escola = Team::where('id', $request_escola)->get();

      $turma = Turma::where('id', $request_turma)->get();

      $ano = AbrirEEncerrarAnoLetivo::where('id', $request_ano)->get();

      $notum = NotumInf::where('aluno_id', $request_aluno)->where('bimestre', $request_bimestre)->where('ano', $request_ano)
      ->where('escola_id', $request_escola)->where('turma_id', $request_turma)->get();

      return view('admin.nota.viewInf', compact('notum', 'request_escola', 'request_turma', 'request_aluno', 'request_ano', 'request_bimestre', 'escola', 'turma', 'ano', 'alunos'));
    }

    public function show(Notum $notum)
    {
        abort_if(Gate::denies('notum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notum->load('disciplina', 'escola', 'turma', 'alunos', 'team', 'assinatura');

        return view('admin.nota.show', compact('notum'));
    }

    public function destroy(Notum $notum)
    {
        abort_if(Gate::denies('notum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notum->delete();

        return back();
    }

    public function massDestroy(MassDestroyNotumRequest $request)
    {
        Notum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
