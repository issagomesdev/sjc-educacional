<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBancoDeProjetoRequest;
use App\Http\Requests\UpdateBancoDeProjetoRequest;
use App\Http\Resources\Admin\BancoDeProjetoResource;
use App\Models\BancoDeProjeto;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BancoDeProjetosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banco_de_projeto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BancoDeProjetoResource(BancoDeProjeto::with(['team', 'assinatura'])->get());
    }

    public function store(StoreBancoDeProjetoRequest $request)
    {
        $bancoDeProjeto = BancoDeProjeto::create($request->all());

        return (new BancoDeProjetoResource($bancoDeProjeto))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BancoDeProjeto $bancoDeProjeto)
    {
        abort_if(Gate::denies('banco_de_projeto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BancoDeProjetoResource($bancoDeProjeto->load(['team', 'assinatura']));
    }

    public function update(UpdateBancoDeProjetoRequest $request, BancoDeProjeto $bancoDeProjeto)
    {
        $bancoDeProjeto->update($request->all());

        return (new BancoDeProjetoResource($bancoDeProjeto))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BancoDeProjeto $bancoDeProjeto)
    {
        abort_if(Gate::denies('banco_de_projeto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjeto->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
