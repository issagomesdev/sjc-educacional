<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriumRequest;
use App\Http\Requests\UpdateMateriumRequest;
use App\Http\Resources\Admin\MateriumResource;
use App\Models\Materium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MateriasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('materium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MateriumResource(Materium::with(['assinatura'])->get());
    }

    public function store(StoreMateriumRequest $request)
    {
        $materium = Materium::create($request->all());

        return (new MateriumResource($materium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Materium $materium)
    {
        abort_if(Gate::denies('materium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MateriumResource($materium->load(['assinatura']));
    }

    public function update(UpdateMateriumRequest $request, Materium $materium)
    {
        $materium->update($request->all());

        return (new MateriumResource($materium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Materium $materium)
    {
        abort_if(Gate::denies('materium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
