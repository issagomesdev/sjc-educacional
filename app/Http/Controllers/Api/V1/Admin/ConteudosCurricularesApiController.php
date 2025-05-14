<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConteudosCurriculareRequest;
use App\Http\Requests\UpdateConteudosCurriculareRequest;
use App\Http\Resources\Admin\ConteudosCurriculareResource;
use App\Models\ConteudosCurriculare;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConteudosCurricularesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('conteudos_curriculare_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConteudosCurriculareResource(ConteudosCurriculare::with(['escola', 'turma', 'disciplina', 'team', 'assinatura'])->get());
    }

    public function store(StoreConteudosCurriculareRequest $request)
    {
        $conteudosCurriculare = ConteudosCurriculare::create($request->all());

        return (new ConteudosCurriculareResource($conteudosCurriculare))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ConteudosCurriculare $conteudosCurriculare)
    {
        abort_if(Gate::denies('conteudos_curriculare_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConteudosCurriculareResource($conteudosCurriculare->load(['escola', 'turma', 'disciplina', 'team', 'assinatura']));
    }

    public function update(UpdateConteudosCurriculareRequest $request, ConteudosCurriculare $conteudosCurriculare)
    {
        $conteudosCurriculare->update($request->all());

        return (new ConteudosCurriculareResource($conteudosCurriculare))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ConteudosCurriculare $conteudosCurriculare)
    {
        abort_if(Gate::denies('conteudos_curriculare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conteudosCurriculare->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
