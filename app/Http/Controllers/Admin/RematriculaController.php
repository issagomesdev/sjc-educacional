<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRematriculaRequest;
use App\Http\Requests\StoreRematriculaRequest;
use App\Http\Requests\UpdateRematriculaRequest;
use App\Models\Cadastro;
use App\Models\Rematricula;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RematriculaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rematricula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rematriculas = Rematricula::with(['escola', 'turma', 'alunos', 'turma_nova', 'team', 'assinatura'])->get();

        $teams = Team::get();

        $turmas = Turma::get();

        $cadastros = Cadastro::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $users = User::get();

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $array_2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->where('situacao', 1)
        ->get();

        $anos_letivos_abertos = json_decode(json_encode($array_2), true);

        return view('admin.rematriculas.index', compact('anos_letivos_abertos', 'anos_letivos', 'auth', 'rematriculas', 'teams', 'turmas', 'cadastros'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('rematricula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escola = $request->escola;

        $ano = $request->ano;

        $turmas = Turma::where('escola_id', $request->escola)->get();

        $alunos = Cadastro::where('escola_id', $request->escola)->pluck('nome_completo', 'id');

        $turma_novas = Turma::pluck('serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rematriculas.create', compact('escolas', 'escola', 'ano', 'turmas', 'alunos', 'turma_novas'));
    }

    public function store(Request $request)
    {
           // dd($request->all());

        $rematricula = Rematricula::create($request->all());
        $rematricula->alunos()->sync($request->input('alunos', []));

        $cadastro = Cadastro::where('id', $request->alunos)->update(['turma_id' => $request->turma_nova_id]);

        return redirect()->route('admin.rematriculas.index');
    }

    public function edit(Rematricula $rematricula)
    {
        abort_if(Gate::denies('rematricula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::pluck('ano_serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $alunos = Cadastro::pluck('nome_completo', 'id');

        $turma_novas = Turma::pluck('ano_serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rematricula->load('escola', 'turma', 'alunos', 'turma_nova', 'team', 'assinatura');

        return view('admin.rematriculas.edit', compact('escolas', 'turmas', 'alunos', 'turma_novas', 'rematricula'));
    }

    public function update(UpdateRematriculaRequest $request, Rematricula $rematricula)
    {
        $rematricula->update($request->all());
        $rematricula->alunos()->sync($request->input('alunos', []));

        return redirect()->route('admin.rematriculas.index');
    }

    public function show(Rematricula $rematricula)
    {
        abort_if(Gate::denies('rematricula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rematricula->load('escola', 'turma', 'alunos', 'turma_nova', 'team', 'assinatura');

        return view('admin.rematriculas.show', compact('rematricula'));
    }

    public function destroy(Rematricula $rematricula)
    {
        abort_if(Gate::denies('rematricula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rematricula->delete();

        return back();
    }

    public function massDestroy(MassDestroyRematriculaRequest $request)
    {
        Rematricula::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
