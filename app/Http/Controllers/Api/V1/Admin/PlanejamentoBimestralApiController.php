<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePlanejamentoBimestralRequest;
use App\Http\Requests\UpdatePlanejamentoBimestralRequest;
use App\Http\Resources\Admin\PlanejamentoBimestralResource;
use App\Models\PlanejamentoBimestral;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanejamentoBimestralApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('planejamento_bimestral_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlanejamentoBimestralResource(PlanejamentoBimestral::with(['disciplina', 'escola', 'turma', 'assinatura', 'team'])->get());
    }

    public function store(StorePlanejamentoBimestralRequest $request)
    {
        $planejamentoBimestral = PlanejamentoBimestral::create($request->all());

        return (new PlanejamentoBimestralResource($planejamentoBimestral))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlanejamentoBimestralResource($planejamentoBimestral->load(['disciplina', 'escola', 'turma', 'assinatura', 'team']));
    }

    public function update(UpdatePlanejamentoBimestralRequest $request, PlanejamentoBimestral $planejamentoBimestral)
    {
        $planejamentoBimestral->update($request->all());

        return (new PlanejamentoBimestralResource($planejamentoBimestral))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planejamentoBimestral->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
