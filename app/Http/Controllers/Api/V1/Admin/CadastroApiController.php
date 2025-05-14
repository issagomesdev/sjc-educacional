<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCadastroRequest;
use App\Http\Requests\UpdateCadastroRequest;
use App\Http\Resources\Admin\CadastroResource;
use App\Models\Cadastro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastroApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cadastro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastroResource(Cadastro::with(['email_do_aluno', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura'])->get());
    }

    public function store(StoreCadastroRequest $request)
    {
        $cadastro = Cadastro::create($request->all());

        if ($request->input('foto_do_aluno', false)) {
            $cadastro->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_do_aluno'))))->toMediaCollection('foto_do_aluno');
        }

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $cadastro->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        return (new CadastroResource($cadastro))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cadastro $cadastro)
    {
        abort_if(Gate::denies('cadastro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastroResource($cadastro->load(['email_do_aluno', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura']));
    }

    public function update(UpdateCadastroRequest $request, Cadastro $cadastro)
    {
        $cadastro->update($request->all());

        if ($request->input('foto_do_aluno', false)) {
            if (!$cadastro->foto_do_aluno || $request->input('foto_do_aluno') !== $cadastro->foto_do_aluno->file_name) {
                if ($cadastro->foto_do_aluno) {
                    $cadastro->foto_do_aluno->delete();
                }
                $cadastro->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_do_aluno'))))->toMediaCollection('foto_do_aluno');
            }
        } elseif ($cadastro->foto_do_aluno) {
            $cadastro->foto_do_aluno->delete();
        }

        if (count($cadastro->arquivos_relacionados) > 0) {
            foreach ($cadastro->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $cadastro->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $cadastro->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return (new CadastroResource($cadastro))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cadastro $cadastro)
    {
        abort_if(Gate::denies('cadastro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastro->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
