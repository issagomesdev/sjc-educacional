<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Requisitante;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisitantesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('requisitante_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::with(['estoques', 'assinatura', 'team'])->get();

        $estoques = Estoque::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.requisitantes.index', compact('estoques', 'requisitantes', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('requisitante_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoques = Estoque::pluck('titulo', 'id');

        return view('admin.requisitantes.create', compact('estoques'));
    }

    public function store(Request $request)
    {
        $requisitante = Requisitante::create($request->all());
        $requisitante->estoques()->sync($request->input('estoques', []));

        return redirect()->route('admin.requisitantes.index');
    }

    public function edit(Requisitante $requisitante)
    {
        abort_if(Gate::denies('requisitante_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoques = Estoque::pluck('titulo', 'id');

        $requisitante->load('estoques', 'assinatura', 'team');

        return view('admin.requisitantes.edit', compact('estoques', 'requisitante'));
    }

    public function update(Request $request, Requisitante $requisitante)
    {
        $requisitante->update($request->all());
        $requisitante->estoques()->sync($request->input('estoques', []));

        return redirect()->route('admin.requisitantes.index');
    }

    public function show(Requisitante $requisitante)
    {
        abort_if(Gate::denies('requisitante_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitante->load('estoques', 'assinatura', 'team');

        return view('admin.requisitantes.show', compact('requisitante'));
    }

    public function destroy(Requisitante $requisitante)
    {
        abort_if(Gate::denies('requisitante_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitante->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Requisitante::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
