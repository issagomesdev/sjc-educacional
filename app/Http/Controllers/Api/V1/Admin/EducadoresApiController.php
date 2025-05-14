<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEducadoreRequest;
use App\Http\Requests\UpdateEducadoreRequest;
use App\Http\Resources\Admin\EducadoreResource;
use App\Models\Educadore;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducadoresApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('educadore_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducadoreResource(Educadore::with(['email_do_usuario', 'instituicao', 'team', 'assinatura'])->get());
    }

    public function store(StoreEducadoreRequest $request)
    {
        $educadore = Educadore::create($request->all());

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $educadore->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        return (new EducadoreResource($educadore))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Educadore $educadore)
    {
        abort_if(Gate::denies('educadore_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducadoreResource($educadore->load(['email_do_usuario', 'instituicao', 'team', 'assinatura']));
    }

    public function update(UpdateEducadoreRequest $request, Educadore $educadore)
    {
        $educadore->update($request->all());

        if (count($educadore->arquivos_relacionados) > 0) {
            foreach ($educadore->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $educadore->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $educadore->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return (new EducadoreResource($educadore))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Educadore $educadore)
    {
        abort_if(Gate::denies('educadore_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educadore->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
