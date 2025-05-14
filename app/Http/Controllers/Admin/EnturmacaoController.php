<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatriculaRequest;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Models\Cadastro;
use App\Models\Matricula;
use App\Models\Team;
use App\Models\Turma;
use App\Models\Vaga;
use App\Models\User;
use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnturmacaoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('matricula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matriculas = Matricula::with(['aluno', 'escola', 'turma', 'team', 'assinatura'])->get();

        $cadastros = Cadastro::get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $tid = Team::where('id', auth()->user()->team_id)->get();

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $array_2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->where('situacao', 1)
        ->get();

        $anos_letivos_abertos = json_decode(json_encode($array_2), true);

        return view('admin.enturmacao.index', compact('auth', 'tid', 'anos_letivos_abertos', 'anos_letivos', 'matriculas', 'cadastros', 'teams', 'turmas'));
    }

    public function create(Request $request)
    {

        abort_if(Gate::denies('matricula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ano = $request->ano;

        $escola = $request->escola;

        $cadastro = Cadastro::get();

        $vagas = Vaga::get();

        $alunos = Cadastro::where('escola_id', $escola)->where('situacao', 0)->pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::where('escola_id', $escola)->get();

        return view('admin.enturmacao.create', compact('vagas', 'ano', 'escola', 'alunos', 'cadastro', 'escolas', 'turmas'));
    }

    public function store(Request $request, Cadastro $cadastro)
    {

        $id = $request->aluno_id;
        $turma = $request->turma_id;

        $cadastro = Cadastro::where('id', $id)->first();
        $cadastro->turma_id = $turma;
        $cadastro->situacao = 1;
        $cadastro->save();
        $matricula = Matricula::create($request->all());

        return redirect()->route('admin.enturmacao.index');
    }

    public function edit(Matricula $matricula)
    {
        abort_if(Gate::denies('matricula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alunos = Cadastro::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::pluck('serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $matricula->load('aluno', 'escola', 'turma', 'team', 'assinatura');

        return view('admin.enturmacao.edit', compact('alunos', 'escolas', 'turmas', 'matricula'));
    }

    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        $matricula->update($request->all());

        return redirect()->route('admin.matriculas.index');
    }

    public function show(Request $request)
    {
        abort_if(Gate::denies('matricula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $enturmacao = Matricula::where('id', $request->id)->get();

        return view('admin.enturmacao.show', compact('enturmacao'));
    }

    public function destroy(Matricula $matricula)
    {
        abort_if(Gate::denies('matricula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matricula->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatriculaRequest $request)
    {
        Matricula::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
