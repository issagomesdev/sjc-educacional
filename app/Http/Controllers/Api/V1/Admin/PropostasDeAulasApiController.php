<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePropostasDeAulaRequest;
use App\Http\Requests\UpdatePropostasDeAulaRequest;
use App\Http\Resources\Admin\PropostasDeAulaResource;
use App\Models\PropostasDeAula;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropostasDeAulasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('propostas_de_aula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropostasDeAulaResource(PropostasDeAula::with(['team', 'assinatura'])->get());
    }

    public function store(StorePropostasDeAulaRequest $request)
    {
        $propostasDeAula = PropostasDeAula::create($request->all());

        return (new PropostasDeAulaResource($propostasDeAula))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PropostasDeAula $propostasDeAula)
    {
        abort_if(Gate::denies('propostas_de_aula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropostasDeAulaResource($propostasDeAula->load(['team', 'assinatura']));
    }

    public function update(UpdatePropostasDeAulaRequest $request, PropostasDeAula $propostasDeAula)
    {
        $propostasDeAula->update($request->all());

        return (new PropostasDeAulaResource($propostasDeAula))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PropostasDeAula $propostasDeAula)
    {
        abort_if(Gate::denies('propostas_de_aula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propostasDeAula->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
