<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVagaRequest;
use App\Http\Requests\UpdateVagaRequest;
use App\Http\Resources\Admin\VagaResource;
use App\Models\Vaga;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VagasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VagaResource(Vaga::with(['escola', 'turma', 'team', 'assinatura'])->get());
    }

    public function store(StoreVagaRequest $request)
    {
        $vaga = Vaga::create($request->all());

        return (new VagaResource($vaga))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Vaga $vaga)
    {
        abort_if(Gate::denies('vaga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VagaResource($vaga->load(['escola', 'turma', 'team', 'assinatura']));
    }

    public function update(UpdateVagaRequest $request, Vaga $vaga)
    {
        $vaga->update($request->all());

        return (new VagaResource($vaga))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Vaga $vaga)
    {
        abort_if(Gate::denies('vaga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaga->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
