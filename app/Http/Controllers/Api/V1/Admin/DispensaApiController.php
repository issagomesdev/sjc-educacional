<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDispensaRequest;
use App\Http\Requests\UpdateDispensaRequest;
use App\Http\Resources\Admin\DispensaResource;
use App\Models\Dispensa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DispensaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dispensa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DispensaResource(Dispensa::with(['disciplinas', 'escola', 'turma', 'alunos', 'team', 'assinatura'])->get());
    }

    public function store(StoreDispensaRequest $request)
    {
        $dispensa = Dispensa::create($request->all());
        $dispensa->disciplinas()->sync($request->input('disciplinas', []));
        $dispensa->alunos()->sync($request->input('alunos', []));

        return (new DispensaResource($dispensa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Dispensa $dispensa)
    {
        abort_if(Gate::denies('dispensa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DispensaResource($dispensa->load(['disciplinas', 'escola', 'turma', 'alunos', 'team', 'assinatura']));
    }

    public function update(UpdateDispensaRequest $request, Dispensa $dispensa)
    {
        $dispensa->update($request->all());
        $dispensa->disciplinas()->sync($request->input('disciplinas', []));
        $dispensa->alunos()->sync($request->input('alunos', []));

        return (new DispensaResource($dispensa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Dispensa $dispensa)
    {
        abort_if(Gate::denies('dispensa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dispensa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
