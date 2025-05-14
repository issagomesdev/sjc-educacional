<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePropostasDeProjetoRequest;
use App\Http\Requests\UpdatePropostasDeProjetoRequest;
use App\Http\Resources\Admin\PropostasDeProjetoResource;
use App\Models\PropostasDeProjeto;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropostasDeProjetosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('propostas_de_projeto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropostasDeProjetoResource(PropostasDeProjeto::with(['team', 'assinatura'])->get());
    }

    public function store(StorePropostasDeProjetoRequest $request)
    {
        $propostasDeProjeto = PropostasDeProjeto::create($request->all());

        return (new PropostasDeProjetoResource($propostasDeProjeto))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PropostasDeProjeto $propostasDeProjeto)
    {
        abort_if(Gate::denies('propostas_de_projeto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropostasDeProjetoResource($propostasDeProjeto->load(['team', 'assinatura']));
    }

    public function update(UpdatePropostasDeProjetoRequest $request, PropostasDeProjeto $propostasDeProjeto)
    {
        $propostasDeProjeto->update($request->all());

        return (new PropostasDeProjetoResource($propostasDeProjeto))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PropostasDeProjeto $propostasDeProjeto)
    {
        abort_if(Gate::denies('propostas_de_projeto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propostasDeProjeto->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
