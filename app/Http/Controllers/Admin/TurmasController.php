<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTurmaRequest;
use App\Http\Requests\StoreTurmaRequest;
use App\Http\Requests\UpdateTurmaRequest;
use App\Models\Cadastro;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TurmasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('turma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $turmas = Turma::with(['escola', 'alunos', 'assinatura', 'team'])->get();

        $teams = Team::get();

        $cadastros = Cadastro::get();

        $users = User::get();

        return view('admin.turmas.index', compact('turmas', 'teams', 'cadastros', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('turma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.turmas.create', compact('auth', 'escolas'));
    }

    public function store(StoreTurmaRequest $request)
    {
      // dd($request->all());
        $turma = Turma::create($request->all());

        return redirect()->route('admin.turmas.index');
    }

    public function edit(Turma $turma)
    {
        abort_if(Gate::denies('turma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $turma->load( 'escola', 'alunos', 'assinatura', 'team');

        return view('admin.turmas.edit', compact('auth', 'escolas', 'turma'));
    }

    public function update(UpdateTurmaRequest $request, Turma $turma)
    {
        $turma->update($request->all());

        return redirect()->route('admin.turmas.index');
    }

    public function show(Turma $turma)
    {
        abort_if(Gate::denies('turma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alunos = Cadastro::where('turma_id', $turma->id)->where('escola_id', $turma->escola_id)->get();

        return view('admin.turmas.show', compact('turma', 'alunos'));
    }

    public function destroy(Turma $turma)
    {
        abort_if(Gate::denies('turma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $turma->delete();

        return back();
    }

    public function massDestroy(MassDestroyTurmaRequest $request)
    {
        Turma::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
