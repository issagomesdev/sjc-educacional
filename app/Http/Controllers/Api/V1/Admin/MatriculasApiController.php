<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Http\Resources\Admin\MatriculaResource;
use App\Models\Matricula;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatriculasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('matricula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatriculaResource(Matricula::with(['aluno', 'escola', 'turma', 'team', 'assinatura'])->get());
    }

    public function store(StoreMatriculaRequest $request)
    {
        $matricula = Matricula::create($request->all());

        return (new MatriculaResource($matricula))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Matricula $matricula)
    {
        abort_if(Gate::denies('matricula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatriculaResource($matricula->load(['aluno', 'escola', 'turma', 'team', 'assinatura']));
    }

    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        $matricula->update($request->all());

        return (new MatriculaResource($matricula))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Matricula $matricula)
    {
        abort_if(Gate::denies('matricula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matricula->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
