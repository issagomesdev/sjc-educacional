<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCadastrarLivroRequest;
use App\Http\Requests\UpdateCadastrarLivroRequest;
use App\Http\Resources\Admin\CadastrarLivroResource;
use App\Models\CadastrarLivro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarLivroApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrar_livro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarLivroResource(CadastrarLivro::with(['biblioteca', 'materias_relacionadas', 'team', 'assinatura'])->get());
    }

    public function store(StoreCadastrarLivroRequest $request)
    {
        $cadastrarLivro = CadastrarLivro::create($request->all());
        $cadastrarLivro->materias_relacionadas()->sync($request->input('materias_relacionadas', []));

        return (new CadastrarLivroResource($cadastrarLivro))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CadastrarLivro $cadastrarLivro)
    {
        abort_if(Gate::denies('cadastrar_livro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarLivroResource($cadastrarLivro->load(['biblioteca', 'materias_relacionadas', 'team', 'assinatura']));
    }

    public function update(UpdateCadastrarLivroRequest $request, CadastrarLivro $cadastrarLivro)
    {
        $cadastrarLivro->update($request->all());
        $cadastrarLivro->materias_relacionadas()->sync($request->input('materias_relacionadas', []));

        return (new CadastrarLivroResource($cadastrarLivro))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CadastrarLivro $cadastrarLivro)
    {
        abort_if(Gate::denies('cadastrar_livro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarLivro->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
