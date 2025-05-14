<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSecretariumRequest;
use App\Http\Requests\UpdateSecretariumRequest;
use App\Http\Resources\Admin\SecretariumResource;
use App\Models\Secretarium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretariaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('secretarium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SecretariumResource(Secretarium::with(['e_mail_do_usuario', 'instituicao', 'assinatura'])->get());
    }

    public function store(StoreSecretariumRequest $request)
    {
        $secretarium = Secretarium::create($request->all());

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $secretarium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        return (new SecretariumResource($secretarium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Secretarium $secretarium)
    {
        abort_if(Gate::denies('secretarium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SecretariumResource($secretarium->load(['e_mail_do_usuario', 'instituicao', 'assinatura']));
    }

    public function update(UpdateSecretariumRequest $request, Secretarium $secretarium)
    {
        $secretarium->update($request->all());

        if (count($secretarium->arquivos_relacionados) > 0) {
            foreach ($secretarium->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $secretarium->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $secretarium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return (new SecretariumResource($secretarium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Secretarium $secretarium)
    {
        abort_if(Gate::denies('secretarium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $secretarium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
