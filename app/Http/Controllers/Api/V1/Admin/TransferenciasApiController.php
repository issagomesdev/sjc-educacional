<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransferenciumRequest;
use App\Http\Requests\UpdateTransferenciumRequest;
use App\Http\Resources\Admin\TransferenciumResource;
use App\Models\Transferencium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferenciasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transferencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransferenciumResource(Transferencium::with(['escola_anterior', 'turma_anterior', 'alunos', 'escola', 'turma_de_destino', 'team', 'assinatura'])->get());
    }

    public function store(StoreTransferenciumRequest $request)
    {
        $transferencium = Transferencium::create($request->all());
        $transferencium->alunos()->sync($request->input('alunos', []));

        return (new TransferenciumResource($transferencium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Transferencium $transferencium)
    {
        abort_if(Gate::denies('transferencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransferenciumResource($transferencium->load(['escola_anterior', 'turma_anterior', 'alunos', 'escola', 'turma_de_destino', 'team', 'assinatura']));
    }

    public function update(UpdateTransferenciumRequest $request, Transferencium $transferencium)
    {
        $transferencium->update($request->all());
        $transferencium->alunos()->sync($request->input('alunos', []));

        return (new TransferenciumResource($transferencium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Transferencium $transferencium)
    {
        abort_if(Gate::denies('transferencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferencium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
