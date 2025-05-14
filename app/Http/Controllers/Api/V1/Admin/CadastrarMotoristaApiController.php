<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCadastrarMotoristumRequest;
use App\Http\Requests\UpdateCadastrarMotoristumRequest;
use App\Http\Resources\Admin\CadastrarMotoristumResource;
use App\Models\CadastrarMotoristum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarMotoristaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cadastrar_motoristum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarMotoristumResource(CadastrarMotoristum::with(['instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreCadastrarMotoristumRequest $request)
    {
        $cadastrarMotoristum = CadastrarMotoristum::create($request->all());

        return (new CadastrarMotoristumResource($cadastrarMotoristum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CadastrarMotoristum $cadastrarMotoristum)
    {
        abort_if(Gate::denies('cadastrar_motoristum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarMotoristumResource($cadastrarMotoristum->load(['instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateCadastrarMotoristumRequest $request, CadastrarMotoristum $cadastrarMotoristum)
    {
        $cadastrarMotoristum->update($request->all());

        return (new CadastrarMotoristumResource($cadastrarMotoristum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CadastrarMotoristum $cadastrarMotoristum)
    {
        abort_if(Gate::denies('cadastrar_motoristum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarMotoristum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
