<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBancoDeAulaRequest;
use App\Http\Requests\UpdateBancoDeAulaRequest;
use App\Http\Resources\Admin\BancoDeAulaResource;
use App\Models\BancoDeAula;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BancoDeAulasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banco_de_aula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BancoDeAulaResource(BancoDeAula::with(['team', 'assinatura'])->get());
    }

    public function store(StoreBancoDeAulaRequest $request)
    {
        $bancoDeAula = BancoDeAula::create($request->all());

        return (new BancoDeAulaResource($bancoDeAula))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BancoDeAula $bancoDeAula)
    {
        abort_if(Gate::denies('banco_de_aula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BancoDeAulaResource($bancoDeAula->load(['team', 'assinatura']));
    }

    public function update(UpdateBancoDeAulaRequest $request, BancoDeAula $bancoDeAula)
    {
        $bancoDeAula->update($request->all());

        return (new BancoDeAulaResource($bancoDeAula))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BancoDeAula $bancoDeAula)
    {
        abort_if(Gate::denies('banco_de_aula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeAula->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
