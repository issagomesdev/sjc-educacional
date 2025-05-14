<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPresencaEletivaRequest;
use App\Http\Requests\StorePresencaEletivaRequest;
use App\Http\Requests\UpdatePresencaEletivaRequest;
use App\Models\AbrirEEncerrarAnoLetivo;
use App\Models\Cadastro;
use App\Models\Materium;
use App\Models\PresencaEletiva;
use Illuminate\Support\Arr;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PresencaEletivaController extends Controller
{

    public function index()
    {

      // dd( $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect')));

      abort_if(Gate::denies('presenca_eletiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $presencaEletivas = PresencaEletiva::with(['ano', 'disciplina', 'escola', 'turmas', 'alunos', 'team', 'assinatura'])->get();

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

      return view('admin.presencaEletivas.index', compact('anos_letivos_abertos', 'anos_letivos', 'presencaEletivas', 'escola', 'disciplinas', 'teams', 'turmas', 'cadastros'));
}

  public function create(request $request)
    {

        abort_if(Gate::denies('presenca_eletiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escola = $request->escola_id;

        $escolav = Team::where('id', $request->escola_id)->get();

        $turma = $request->turma_id;

        $ano = $request->ano;

        $turmav = Turma::where('id', $request->turma_id)->get();

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $alunos = Cadastro::where('escola_id', $escola)->where('turma_id', $turma)->get();

        return view('admin.presencaEletivas.create', compact('ano', 'disciplinas', 'alunos', 'escola', 'turma', 'escolav', 'turmav'));
    }


    public function store(StorePresencaEletivaRequest $request)
    {

      // dd($request->all());

        $array1 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'aluno_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $get1 = array_values($array1);

        $new1 = collect($get1)->pluck('0');

        $alunos = Arr::collapse([$new1]);

        $array2 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'pxf_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $get2 = array_values($array2);

        $new2 = collect($get2)->pluck('0');

        $pxf = Arr::collapse([$new2]);

        $array3 = array_filter(request()->all(), function ($key) {
            return strpos($key, 'selecionar_motivo_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $get3 = array_values($array3);

        $new3 = collect($get3)->pluck('0');

        $motivo = Arr::collapse([$new3]);

      for ($i=0; $i < sizeof($alunos); $i++) {

        $presencaEletiva['alunos_id'] = $alunos[$i];
        $presencaEletiva['data'] = $request->data;
        $presencaEletiva['ano'] = $request->ano;
        $presencaEletiva ['disciplina_id'] = $request->disciplina_id;
        $presencaEletiva['bimestre'] = $request->bimestre;
        $presencaEletiva['selecione_falta'] = $pxf[$i];
        $presencaEletiva['selecionar_motivo'] = $motivo[$i];
        $presencaEletiva['team_id'] = $request-> team_id;
        $presencaEletiva['escola_id'] = $request->escola_id;
        $presencaEletiva['turmas_id'] = $request->turma_id;
        $presencaEletiva['assinatura_id'] = $request-> user_id;
        PresencaEletiva::create($presencaEletiva);

      }

        return redirect()->route('admin.presenca-eletivas.index');
    }


    public function refresh(request $request, PresencaEletiva $presencaEletiva)
    {

      // dd($request->all());

      abort_if(Gate::denies('presenca_eletiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


      $escola = Team::where('id', $request->escola_id)->get();

      $turma = Turma::where('id', $request->turma_id)->get();

      $ano = AbrirEEncerrarAnoLetivo::where('id', $request->ano)->get();

      $data = $request->data;

      $disciplina = Materium::where('id', $request->disciplina_id)->get();

      $bimestre = $request->bimestre;

      $alunos = Cadastro::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->get();

      $presencaEletivas = presencaEletiva::where('escola_id', $request->escola_id)
      ->where('turmas_id', $request->turma_id)->where('disciplina_id', $request->disciplina_id)
      ->where('data', $request->data)->where('ano', $request->ano)->where('bimestre', $bimestre)->get();

    return view('admin.presencaEletivas.refresh', compact('presencaEletivas', 'ano', 'escola','turma', 'data', 'disciplina', 'bimestre', 'alunos'));
    }

    public function update(UpdatePresencaEletivaRequest $request, PresencaEletiva $presencaEletiva)
       {
         // dd($request->all());

         $array1 = array_filter(request()->all(), function ($key) {
             return strpos($key, 'aluno_') === 0;
         }, ARRAY_FILTER_USE_KEY);

         $get1 = array_values($array1);

         $new1 = collect($get1)->pluck('0');

         $alunos = Arr::collapse([$new1]);

         $array2 = array_filter(request()->all(), function ($key) {
             return strpos($key, 'pxf_') === 0;
         }, ARRAY_FILTER_USE_KEY);

         $get2 = array_values($array2);

         $new2 = collect($get2)->pluck('0');

         $pxf = Arr::collapse([$new2]);

         $array3 = array_filter(request()->all(), function ($key) {
             return strpos($key, 'selecionar_motivo_') === 0;
         }, ARRAY_FILTER_USE_KEY);

         $get3 = array_values($array3);

         $new3 = collect($get3)->pluck('0');

         $motivo = Arr::collapse([$new3]);

         for ($i=0; $i < sizeof($alunos); $i++) {
         $presencaEletiva['selecione_falta'] = $pxf[$i];
         $presencaEletiva['selecionar_motivo'] = $motivo[$i];
         // $presencaEletiva->save();
       }


        return redirect()->route('admin.presenca-eletivas.index');
          }


       public function view(request $request, PresencaEletiva $presencaEletiva)
       {

         // dd($presencaEletiva = presencaEletiva::where('escola_id', $request->escola_id)->where('turmas_id', $request->turmas_id)->where('disciplina_id', $request->disciplina_id)->where('data', Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d'))->where('bimestre', $bimestre = $request->bimestre)->get());
         // dd($data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d'));

         abort_if(Gate::denies('presenca_eletiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $escola = Team::where('id', $request->escola_id)->get();

         $turma = Turma::where('id', $request->turma_id)->get();

         $ano = AbrirEEncerrarAnoLetivo::where('id', $request->ano)->get();

         $data = $request->data;

         $disciplina = Materium::where('id', $request->disciplina_id)->get();

         $bimestre = $request->bimestre;

         $alunos = Cadastro::where('escola_id', $request->escola_id)->where('turma_id', $request->turma_id)->get();

         $presencaEletivas = presencaEletiva::where('escola_id', $request->escola_id)
         ->where('turmas_id', $request->turma_id)->where('disciplina_id', $request->disciplina_id)
         ->where('data', $request->data)->where('ano', $request->ano)->where('bimestre', $bimestre)->get();

       return view('admin.presencaEletivas.view', compact('presencaEletivas', 'ano', 'escola','turma', 'data', 'disciplina', 'bimestre', 'alunos'));
       }

       public function show(PresencaEletiva $presencaEletiva)
       {
           abort_if(Gate::denies('presenca_eletiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

           $presencaEletiva->load('disciplina', 'escola', 'turmas', 'alunos', 'team', 'assinatura');

           return view('admin.presencaEletivas.show', compact('presencaEletiva'));
       }

   }
