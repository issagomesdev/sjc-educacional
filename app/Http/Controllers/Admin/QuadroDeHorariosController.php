<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuadroDeHorarioRequest;
use App\Http\Requests\StoreQuadroDeHorarioRequest;
use App\Http\Requests\UpdateQuadroDeHorarioRequest;
use App\Models\Profissionai;
use App\Models\Materium;
use App\Models\QuadroDeHorario;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuadroDeHorariosController extends Controller
{
    public function index(QuadroDeHorario $horario)
    {
        abort_if(Gate::denies('quadro_de_horario_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quadroDeHorarios = QuadroDeHorario::with(['escola', 'turma', 'materias', 'professor', 'team', 'assinatura'])->get();

        $materia = Materium::get();

        $educadores = Profissionai::get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $tid = Team::where('id', auth()->user()->team_id)->get();

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $users = User::get();

        return view('admin.quadroDeHorarios.index', compact('quadroDeHorarios', 'materia', 'educadores', 'teams', 'tid', 'turmas',  'auth', 'anos_letivos','users'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('quadro_de_horario_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ano = $request->ano;

        $escola = $request->escola;

        $turma = Turma::get();

        $materias = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $professors = Profissionai::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.quadroDeHorarios.create', compact('escola', 'ano', 'turma', 'materias', 'professors'));
    }

    public function store(StoreQuadroDeHorarioRequest $request)
    {
        $quadroDeHorario = QuadroDeHorario::create($request->all());

        return redirect()->route('admin.quadro-de-horarios.index');
    }

    public function edit(QuadroDeHorario $quadroDeHorario)
    {
        abort_if(Gate::denies('quadro_de_horario_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turma = Turma::get();

        $materias = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $professors = Profissionai::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quadroDeHorario->load('escola', 'turma', 'materias', 'professor', 'team', 'assinatura');

        return view('admin.quadroDeHorarios.edit', compact( 'escolas', 'turma', 'materias', 'professors', 'quadroDeHorario'));
    }

    public function update(UpdateQuadroDeHorarioRequest $request, QuadroDeHorario $quadroDeHorario)
    {
        $quadroDeHorario->update($request->all());

        return redirect()->route('admin.quadro-de-horarios.index');
    }

    public function show(QuadroDeHorario $quadroDeHorario)
    {
        abort_if(Gate::denies('quadro_de_horario_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quadroDeHorario->load('escola', 'turma', 'materias', 'professor', 'team', 'assinatura');

        return view('admin.quadroDeHorarios.show', compact('quadroDeHorario'));
    }

    public function destroy(QuadroDeHorario $quadroDeHorario)
    {
        abort_if(Gate::denies('quadro_de_horario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quadroDeHorario->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuadroDeHorarioRequest $request)
    {
        QuadroDeHorario::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
