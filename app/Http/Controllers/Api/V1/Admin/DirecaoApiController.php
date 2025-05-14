<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDirecaoRequest;
use App\Http\Requests\UpdateDirecaoRequest;
use App\Http\Resources\Admin\DirecaoResource;
use App\Models\Direcao;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DirecaoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('direcao_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DirecaoResource(Direcao::with(['e_mail_de_usuario', 'instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreDirecaoRequest $request)
    {
        $direcao = Direcao::create($request->all());

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $direcao->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        return (new DirecaoResource($direcao))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Direcao $direcao)
    {
        abort_if(Gate::denies('direcao_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DirecaoResource($direcao->load(['e_mail_de_usuario', 'instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateDirecaoRequest $request, Direcao $direcao)
    {
        $direcao->update($request->all());

        if (count($direcao->arquivos_relacionados) > 0) {
            foreach ($direcao->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $direcao->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $direcao->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return (new DirecaoResource($direcao))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Direcao $direcao)
    {
        abort_if(Gate::denies('direcao_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $direcao->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
