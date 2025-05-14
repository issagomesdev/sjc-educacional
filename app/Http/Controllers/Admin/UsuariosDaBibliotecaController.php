<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\UsuariosDaBiblioteca;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuariosDaBibliotecaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('usuarios_da_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuariosDaBibliotecas = UsuariosDaBiblioteca::with(['team', 'assinatura'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.usuariosDaBibliotecas.index', compact('teams', 'users', 'usuariosDaBibliotecas'));
    }

    public function create()
    {
        abort_if(Gate::denies('usuarios_da_biblioteca_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.usuariosDaBibliotecas.create');
    }

    public function store(Request $request)
    {
        $usuariosDaBiblioteca = UsuariosDaBiblioteca::create($request->all());

        return redirect()->route('admin.usuarios-da-bibliotecas.index');
    }

    public function edit(UsuariosDaBiblioteca $usuariosDaBiblioteca)
    {
        abort_if(Gate::denies('usuarios_da_biblioteca_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuariosDaBiblioteca->load('team', 'assinatura');

        return view('admin.usuariosDaBibliotecas.edit', compact('usuariosDaBiblioteca'));
    }

    public function update(Request $request, UsuariosDaBiblioteca $usuariosDaBiblioteca)
    {
        $usuariosDaBiblioteca->update($request->all());

        return redirect()->route('admin.usuarios-da-bibliotecas.index');
    }

    public function show(UsuariosDaBiblioteca $usuariosDaBiblioteca)
    {
        abort_if(Gate::denies('usuarios_da_biblioteca_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuariosDaBiblioteca->load('team', 'assinatura');

        return view('admin.usuariosDaBibliotecas.show', compact('usuariosDaBiblioteca'));
    }

    public function destroy(UsuariosDaBiblioteca $usuariosDaBiblioteca)
    {
        abort_if(Gate::denies('usuarios_da_biblioteca_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuariosDaBiblioteca->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        UsuariosDaBiblioteca::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
