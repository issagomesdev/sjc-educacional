<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCadastrarveiculoRequest;
use App\Http\Requests\UpdateCadastrarveiculoRequest;
use App\Http\Resources\Admin\CadastrarveiculoResource;
use App\Models\Cadastrarveiculo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarveiculoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrarveiculo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarveiculoResource(Cadastrarveiculo::with(['instituicao', 'motorista_responsavels', 'team', 'assinatura'])->get());
    }

    public function store(StoreCadastrarveiculoRequest $request)
    {
        $cadastrarveiculo = Cadastrarveiculo::create($request->all());
        $cadastrarveiculo->motorista_responsavels()->sync($request->input('motorista_responsavels', []));

        return (new CadastrarveiculoResource($cadastrarveiculo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cadastrarveiculo $cadastrarveiculo)
    {
        abort_if(Gate::denies('cadastrarveiculo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarveiculoResource($cadastrarveiculo->load(['instituicao', 'motorista_responsavels', 'team', 'assinatura']));
    }

    public function update(UpdateCadastrarveiculoRequest $request, Cadastrarveiculo $cadastrarveiculo)
    {
        $cadastrarveiculo->update($request->all());
        $cadastrarveiculo->motorista_responsavels()->sync($request->input('motorista_responsavels', []));

        return (new CadastrarveiculoResource($cadastrarveiculo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cadastrarveiculo $cadastrarveiculo)
    {
        abort_if(Gate::denies('cadastrarveiculo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarveiculo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
