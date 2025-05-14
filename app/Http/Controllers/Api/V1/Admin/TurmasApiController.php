<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTurmaRequest;
use App\Http\Requests\UpdateTurmaRequest;
use App\Http\Resources\Admin\TurmaResource;
use App\Models\Turma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TurmasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('turma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TurmaResource(Turma::with(['escola', 'alunos', 'assinatura', 'team'])->get());
    }

    public function store(StoreTurmaRequest $request)
    {
        $turma = Turma::create($request->all());
        $turma->alunos()->sync($request->input('alunos', []));

        return (new TurmaResource($turma))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Turma $turma)
    {
        abort_if(Gate::denies('turma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TurmaResource($turma->load(['escola', 'alunos', 'assinatura', 'team']));
    }

    public function update(UpdateTurmaRequest $request, Turma $turma)
    {
        $turma->update($request->all());
        $turma->alunos()->sync($request->input('alunos', []));

        return (new TurmaResource($turma))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Turma $turma)
    {
        abort_if(Gate::denies('turma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $turma->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
