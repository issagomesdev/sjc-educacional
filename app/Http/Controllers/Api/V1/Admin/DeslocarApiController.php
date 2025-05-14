<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeslocarRequest;
use App\Http\Requests\UpdateDeslocarRequest;
use App\Http\Resources\Admin\DeslocarResource;
use App\Models\Deslocar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeslocarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('deslocar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeslocarResource(Deslocar::with(['instituicao_anterior', 'hierarquia', 'profissional', 'instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreDeslocarRequest $request)
    {
        $deslocar = Deslocar::create($request->all());

        return (new DeslocarResource($deslocar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Deslocar $deslocar)
    {
        abort_if(Gate::denies('deslocar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeslocarResource($deslocar->load(['instituicao_anterior', 'hierarquia', 'profissional', 'instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateDeslocarRequest $request, Deslocar $deslocar)
    {
        $deslocar->update($request->all());

        return (new DeslocarResource($deslocar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Deslocar $deslocar)
    {
        abort_if(Gate::denies('deslocar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deslocar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
