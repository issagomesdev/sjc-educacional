<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMinhasTurmaRequest;
use App\Http\Requests\StoreMinhasTurmaRequest;
use App\Http\Requests\UpdateMinhasTurmaRequest;
use Gate;
use App\Models\QuadroDeHorario;
use App\Models\User;
use App\Models\Profissionai;
use App\Models\Cadastro;
use App\Models\Turma;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinhasTurmasController extends Controller
{
    public function index(Turma $turmas)
    {
        abort_if(Gate::denies('minhas_turma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user()->id;

        $profissional = Profissionai::where('id', $user)->first('id');

        $quadro = QuadroDeHorario::where('professor_id', $profissional->id)->get('ano_serie_id')->toArray();

        $collection = collect($quadro);

        $uni = Arr::collapse([$collection]);

        $new = collect($uni)->pluck('ano_serie_id');

        $newcollection = Arr::collapse([$new]);

        $turma = Turma::whereIn('id', $newcollection)->get();

        return view('admin.minhasTurmas.index', compact('turma'));
    }

    public function create()
    {
        abort_if(Gate::denies('minhas_turma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasTurmas.create');
    }

    public function store(StoreMinhasTurmaRequest $request)
    {
        $minhasTurma = MinhasTurma::create($request->all());

        return redirect()->route('admin.minhas-turmas.index');
    }

    public function edit(MinhasTurma $minhasTurma)
    {
        abort_if(Gate::denies('minhas_turma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasTurmas.edit', compact('minhasTurma'));
    }

    public function update(UpdateMinhasTurmaRequest $request, MinhasTurma $minhasTurma)
    {
        $minhasTurma->update($request->all());

        return redirect()->route('admin.minhas-turmas.index');
    }

    public function show(MinhasTurma $minhasTurma)
    {
        abort_if(Gate::denies('minhas_turma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minhasTurmas.show', compact('minhasTurma'));
    }

    public function destroy(MinhasTurma $minhasTurma)
    {
        abort_if(Gate::denies('minhas_turma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minhasTurma->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinhasTurmaRequest $request)
    {
        MinhasTurma::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
