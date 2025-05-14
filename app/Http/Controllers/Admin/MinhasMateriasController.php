<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMinhasMateriumRequest;
use App\Http\Requests\StoreMinhasMateriumRequest;
use App\Http\Requests\UpdateMinhasMateriumRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinhasMateriasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('minhas_materium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasMateria.index');
    }

    public function create()
    {
        abort_if(Gate::denies('minhas_materium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasMateria.create');
    }

    public function store(StoreMinhasMateriumRequest $request)
    {
        $minhasMaterium = MinhasMaterium::create($request->all());

        return redirect()->route('admin.minhas-materia.index');
    }

    public function edit(MinhasMaterium $minhasMaterium)
    {
        abort_if(Gate::denies('minhas_materium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasMateria.edit', compact('minhasMaterium'));
    }

    public function update(UpdateMinhasMateriumRequest $request, MinhasMaterium $minhasMaterium)
    {
        $minhasMaterium->update($request->all());

        return redirect()->route('admin.minhas-materia.index');
    }

    public function show(MinhasMaterium $minhasMaterium)
    {
        abort_if(Gate::denies('minhas_materium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasMateria.show', compact('minhasMaterium'));
    }

    public function destroy(MinhasMaterium $minhasMaterium)
    {
        abort_if(Gate::denies('minhas_materium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minhasMaterium->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinhasMateriumRequest $request)
    {
        MinhasMaterium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
