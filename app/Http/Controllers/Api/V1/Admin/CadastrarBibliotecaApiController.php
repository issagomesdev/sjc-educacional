<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCadastrarBibliotecaRequest;
use App\Http\Requests\UpdateCadastrarBibliotecaRequest;
use App\Http\Resources\Admin\CadastrarBibliotecaResource;
use App\Models\CadastrarBiblioteca;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarBibliotecaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrar_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarBibliotecaResource(CadastrarBiblioteca::with(['team', 'assinatura'])->get());
    }

    public function store(StoreCadastrarBibliotecaRequest $request)
    {
        $cadastrarBiblioteca = CadastrarBiblioteca::create($request->all());

        return (new CadastrarBibliotecaResource($cadastrarBiblioteca))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CadastrarBiblioteca $cadastrarBiblioteca)
    {
        abort_if(Gate::denies('cadastrar_biblioteca_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CadastrarBibliotecaResource($cadastrarBiblioteca->load(['team', 'assinatura']));
    }

    public function update(UpdateCadastrarBibliotecaRequest $request, CadastrarBiblioteca $cadastrarBiblioteca)
    {
        $cadastrarBiblioteca->update($request->all());

        return (new CadastrarBibliotecaResource($cadastrarBiblioteca))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CadastrarBiblioteca $cadastrarBiblioteca)
    {
        abort_if(Gate::denies('cadastrar_biblioteca_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarBiblioteca->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
