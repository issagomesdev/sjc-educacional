<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresencaEletivaRequest;
use App\Http\Requests\UpdatePresencaEletivaRequest;
use App\Http\Resources\Admin\PresencaEletivaResource;
use App\Models\PresencaEletiva;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PresencaEletivaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('presenca_eletiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresencaEletivaResource(PresencaEletiva::with(['disciplina', 'escola', 'turmas', 'alunos', 'team', 'assinatura'])->get());
    }

    public function store(StorePresencaEletivaRequest $request)
    {
        $presencaEletiva = PresencaEletiva::create($request->all());

        return (new PresencaEletivaResource($presencaEletiva))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PresencaEletiva $presencaEletiva)
    {
        abort_if(Gate::denies('presenca_eletiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresencaEletivaResource($presencaEletiva->load(['disciplina', 'escola', 'turmas', 'alunos', 'team', 'assinatura']));
    }

    public function update(UpdatePresencaEletivaRequest $request, PresencaEletiva $presencaEletiva)
    {
        $presencaEletiva->update($request->all());

        return (new PresencaEletivaResource($presencaEletiva))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PresencaEletiva $presencaEletiva)
    {
        abort_if(Gate::denies('presenca_eletiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presencaEletiva->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
