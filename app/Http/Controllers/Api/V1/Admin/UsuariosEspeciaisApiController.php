<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUsuariosEspeciaiRequest;
use App\Http\Requests\UpdateUsuariosEspeciaiRequest;
use App\Http\Resources\Admin\UsuariosEspeciaiResource;
use App\Models\UsuariosEspeciai;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuariosEspeciaisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('usuarios_especiai_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsuariosEspeciaiResource(UsuariosEspeciai::with(['e_mail_de_usuario', 'instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreUsuariosEspeciaiRequest $request)
    {
        $usuariosEspeciai = UsuariosEspeciai::create($request->all());

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $usuariosEspeciai->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        return (new UsuariosEspeciaiResource($usuariosEspeciai))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UsuariosEspeciai $usuariosEspeciai)
    {
        abort_if(Gate::denies('usuarios_especiai_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsuariosEspeciaiResource($usuariosEspeciai->load(['e_mail_de_usuario', 'instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateUsuariosEspeciaiRequest $request, UsuariosEspeciai $usuariosEspeciai)
    {
        $usuariosEspeciai->update($request->all());

        if (count($usuariosEspeciai->arquivos_relacionados) > 0) {
            foreach ($usuariosEspeciai->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $usuariosEspeciai->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $usuariosEspeciai->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return (new UsuariosEspeciaiResource($usuariosEspeciai))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UsuariosEspeciai $usuariosEspeciai)
    {
        abort_if(Gate::denies('usuarios_especiai_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuariosEspeciai->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
