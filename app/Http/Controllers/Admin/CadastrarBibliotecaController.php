<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCadastrarBibliotecaRequest;
use App\Http\Requests\StoreCadastrarBibliotecaRequest;
use App\Http\Requests\UpdateCadastrarBibliotecaRequest;
use App\Models\CadastrarBiblioteca;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarBibliotecaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrar_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarBibliotecas = CadastrarBiblioteca::with(['team', 'assinatura'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.cadastrarBibliotecas.index', compact('cadastrarBibliotecas', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('cadastrar_biblioteca_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cadastrarBibliotecas.create');
    }

    public function store(StoreCadastrarBibliotecaRequest $request)
    {
        $cadastrarBiblioteca = CadastrarBiblioteca::create($request->all());

        return redirect()->route('admin.cadastrar-bibliotecas.index');
    }

    public function edit(CadastrarBiblioteca $cadastrarBiblioteca)
    {
        abort_if(Gate::denies('cadastrar_biblioteca_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarBiblioteca->load('team', 'assinatura');

        return view('admin.cadastrarBibliotecas.edit', compact('cadastrarBiblioteca'));
    }

    public function update(UpdateCadastrarBibliotecaRequest $request, CadastrarBiblioteca $cadastrarBiblioteca)
    {
        $cadastrarBiblioteca->update($request->all());

        return redirect()->route('admin.cadastrar-bibliotecas.index');
    }

    public function show(CadastrarBiblioteca $cadastrarBiblioteca)
    {
        abort_if(Gate::denies('cadastrar_biblioteca_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarBiblioteca->load('team', 'assinatura', 'bibliotecaCadastrarLivros');

        return view('admin.cadastrarBibliotecas.show', compact('cadastrarBiblioteca'));
    }

    public function destroy(CadastrarBiblioteca $cadastrarBiblioteca)
    {
        abort_if(Gate::denies('cadastrar_biblioteca_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarBiblioteca->delete();

        return back();
    }

    public function massDestroy(MassDestroyCadastrarBibliotecaRequest $request)
    {
        CadastrarBiblioteca::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
