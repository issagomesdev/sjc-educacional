<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstalarRequest;
use App\Http\Requests\UpdateInstalarRequest;
use App\Http\Resources\Admin\InstalarResource;
use App\Models\Instalar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstalarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('instalar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstalarResource(Instalar::with(['hierarquia', 'profissional', 'instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreInstalarRequest $request)
    {
        $instalar = Instalar::create($request->all());

        return (new InstalarResource($instalar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Instalar $instalar)
    {
        abort_if(Gate::denies('instalar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstalarResource($instalar->load(['hierarquia', 'profissional', 'instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateInstalarRequest $request, Instalar $instalar)
    {
        $instalar->update($request->all());

        return (new InstalarResource($instalar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Instalar $instalar)
    {
        abort_if(Gate::denies('instalar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
