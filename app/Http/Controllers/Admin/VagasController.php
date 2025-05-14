<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVagaRequest;
use App\Http\Requests\StoreVagaRequest;
use App\Http\Requests\UpdateVagaRequest;
use App\Models\Team;
use App\Models\Turma;
use App\Models\Cadastro;
use App\Models\User;
use App\Models\Vaga;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VagasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vagas = Vaga::with(['escola', 'turma', 'team', 'assinatura'])->get();

        $teams = Team::get();

        $turmas = Turma::get();

        $users = User::get();

        return view('admin.vagas.index', compact('vagas', 'teams', 'turmas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('vaga_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        return view('admin.vagas.create', compact('auth', 'escolas', 'turmas'));
    }

    public function store(StoreVagaRequest $request)
    {
        $vaga = Vaga::create($request->all());

        return redirect()->route('admin.vagas.index');
    }

    public function edit(Vaga $vaga)
    {
        abort_if(Gate::denies('vaga_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $vaga->load('escola', 'turma', 'team', 'assinatura');

        return view('admin.vagas.edit', compact('auth', 'escolas', 'turmas', 'vaga'));
    }

    public function update(UpdateVagaRequest $request, Vaga $vaga)
    {
        $vaga->update($request->all());

        return redirect()->route('admin.vagas.index');
    }

    public function show(Vaga $vaga)
    {
        abort_if(Gate::denies('vaga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaga->load('escola', 'turma', 'team', 'assinatura');

        return view('admin.vagas.show', compact('vaga'));
    }

    public function destroy(Vaga $vaga)
    {
        abort_if(Gate::denies('vaga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaga->delete();

        return back();
    }

    public function massDestroy(MassDestroyVagaRequest $request)
    {
        Vaga::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
