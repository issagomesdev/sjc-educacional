<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMinhasAulaRequest;
use App\Http\Requests\StoreMinhasAulaRequest;
use App\Http\Requests\UpdateMinhasAulaRequest;
use Gate;
use App\Models\QuadroDeHorario;
use App\Models\User;
use App\Models\Profissionai;
use App\Models\Cadastro;
use App\Models\Turma;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinhasAulasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('minhas_aula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user()->id;

        $profissional = Profissionai::where('id', $user)->first('id');

        $quadro = QuadroDeHorario::where('professor_id', $profissional->id)->get();

        return view('admin.minhasAulas.index', compact('quadro'));
    }

    public function create()
    {
        abort_if(Gate::denies('minhas_aula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasAulas.create');
    }

    public function store(StoreMinhasAulaRequest $request)
    {
        $minhasAula = MinhasAula::create($request->all());

        return redirect()->route('admin.minhas-aulas.index');
    }

    public function edit(MinhasAula $minhasAula)
    {
        abort_if(Gate::denies('minhas_aula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasAulas.edit', compact('minhasAula'));
    }

    public function update(UpdateMinhasAulaRequest $request, MinhasAula $minhasAula)
    {
        $minhasAula->update($request->all());

        return redirect()->route('admin.minhas-aulas.index');
    }

    public function show(MinhasAula $minhasAula)
    {
        abort_if(Gate::denies('minhas_aula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasAulas.show', compact('minhasAula'));
    }

    public function destroy(MinhasAula $minhasAula)
    {
        abort_if(Gate::denies('minhas_aula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minhasAula->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinhasAulaRequest $request)
    {
        MinhasAula::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
