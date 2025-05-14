<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMateriumRequest;
use App\Http\Requests\StoreMateriumRequest;
use App\Http\Requests\UpdateMateriumRequest;
use App\Models\Materium;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MateriasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('materium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materia = Materium::with(['assinatura'])->get();

        $users = User::get();

        return view('admin.materia.index', compact('materia', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('materium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.materia.create');
    }

    public function store(StoreMateriumRequest $request)
    {
        $materium = Materium::create($request->all());

        return redirect()->route('admin.materia.index');
    }

    public function edit(Materium $materium)
    {
        abort_if(Gate::denies('materium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materium->load('assinatura');

        return view('admin.materia.edit', compact('materium'));
    }

    public function update(UpdateMateriumRequest $request, Materium $materium)
    {
        $materium->update($request->all());

        return redirect()->route('admin.materia.index');
    }

    public function show(Materium $materium)
    {
        abort_if(Gate::denies('materium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materium->load('assinatura', 'materiasQuadroDeHorarios', 'disciplinaPresencaEletivas', 'disciplinaConteudosCurriculares', 'disciplinaPlanejamentoBimestrals', 'disciplinaNota', 'disciplinasDispensas');

        return view('admin.materia.show', compact('materium'));
    }

    public function destroy(Materium $materium)
    {
        abort_if(Gate::denies('materium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materium->delete();

        return back();
    }

    public function massDestroy(MassDestroyMateriumRequest $request)
    {
        Materium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
