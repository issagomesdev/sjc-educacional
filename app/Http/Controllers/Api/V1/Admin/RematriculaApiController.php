<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRematriculaRequest;
use App\Http\Requests\UpdateRematriculaRequest;
use App\Http\Resources\Admin\RematriculaResource;
use App\Models\Rematricula;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RematriculaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rematricula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RematriculaResource(Rematricula::with(['escola', 'turma', 'alunos', 'turma_nova', 'team', 'assinatura'])->get());
    }

    public function store(StoreRematriculaRequest $request)
    {
        $rematricula = Rematricula::create($request->all());
        $rematricula->alunos()->sync($request->input('alunos', []));

        return (new RematriculaResource($rematricula))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rematricula $rematricula)
    {
        abort_if(Gate::denies('rematricula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RematriculaResource($rematricula->load(['escola', 'turma', 'alunos', 'turma_nova', 'team', 'assinatura']));
    }

    public function update(UpdateRematriculaRequest $request, Rematricula $rematricula)
    {
        $rematricula->update($request->all());
        $rematricula->alunos()->sync($request->input('alunos', []));

        return (new RematriculaResource($rematricula))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rematricula $rematricula)
    {
        abort_if(Gate::denies('rematricula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rematricula->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
