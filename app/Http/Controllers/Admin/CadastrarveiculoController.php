<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCadastrarveiculoRequest;
use App\Http\Requests\StoreCadastrarveiculoRequest;
use App\Http\Requests\UpdateCadastrarveiculoRequest;
use App\Models\CadastrarMotoristum;
use App\Models\Cadastrarveiculo;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarveiculoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrarveiculo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarveiculos = Cadastrarveiculo::with(['instituicao', 'motorista_responsavels', 'team', 'assinatura'])->get();

        $teams = Team::get();

        $cadastrar_motorista = CadastrarMotoristum::get();

        $users = User::get();

        return view('admin.cadastrarveiculos.index', compact('cadastrarveiculos', 'teams', 'cadastrar_motorista', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('cadastrarveiculo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $motorista_responsavels = CadastrarMotoristum::pluck('nome_completo', 'id');

        return view('admin.cadastrarveiculos.create', compact('instituicaos', 'motorista_responsavels'));
    }

    public function store(StoreCadastrarveiculoRequest $request)
    {
        $cadastrarveiculo = Cadastrarveiculo::create($request->all());
        $cadastrarveiculo->motorista_responsavels()->sync($request->input('motorista_responsavels', []));

        return redirect()->route('admin.cadastrarveiculos.index');
    }

    public function edit(Cadastrarveiculo $cadastrarveiculo)
    {
        abort_if(Gate::denies('cadastrarveiculo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $motorista_responsavels = CadastrarMotoristum::pluck('nome_completo', 'id');

        $cadastrarveiculo->load('instituicao', 'motorista_responsavels', 'team', 'assinatura');

        return view('admin.cadastrarveiculos.edit', compact('instituicaos', 'motorista_responsavels', 'cadastrarveiculo'));
    }

    public function update(UpdateCadastrarveiculoRequest $request, Cadastrarveiculo $cadastrarveiculo)
    {
        $cadastrarveiculo->update($request->all());
        $cadastrarveiculo->motorista_responsavels()->sync($request->input('motorista_responsavels', []));

        return redirect()->route('admin.cadastrarveiculos.index');
    }

    public function show(Cadastrarveiculo $cadastrarveiculo)
    {
        abort_if(Gate::denies('cadastrarveiculo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarveiculo->load('instituicao', 'motorista_responsavels', 'team', 'assinatura', 'veiculoResponsavelRota');

        return view('admin.cadastrarveiculos.show', compact('cadastrarveiculo'));
    }

    public function destroy(Cadastrarveiculo $cadastrarveiculo)
    {
        abort_if(Gate::denies('cadastrarveiculo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarveiculo->delete();

        return back();
    }

    public function massDestroy(MassDestroyCadastrarveiculoRequest $request)
    {
        Cadastrarveiculo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
