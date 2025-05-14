<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeusAlunoRequest;
use App\Http\Requests\StoreMeusAlunoRequest;
use App\Http\Requests\UpdateMeusAlunoRequest;
use Gate;
use App\Models\QuadroDeHorario;
use App\Models\User;
use App\Models\Profissionai;
use App\Models\Cadastro;
use App\Models\Turma;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeusAlunosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('meus_aluno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user()->id;

        $profissional = Profissionai::where('id', $user)->first('id');

        $quadro = QuadroDeHorario::where('professor_id', $profissional->id)->get('ano_serie_id')->toArray();

        $collection = collect($quadro);

        $uni = Arr::collapse([$collection]);

        $new = collect($uni)->pluck('ano_serie_id');

        $newcollection = Arr::collapse([$new]);

        $turma = Turma::whereIn('id', $newcollection)->get();

        // dd($request->id_turma);

        $turmid = $request->id_turma;

        $alunos = Cadastro::where('turma_id', $request->id_turma)->get();

        return view('admin.meusAlunos.index', compact('alunos', 'turma', 'turmid'));
    }

    public function create()
    {
        abort_if(Gate::denies('meus_aluno_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meusAlunos.create');
    }

    public function store(StoreMeusAlunoRequest $request)
    {
        $meusAluno = MeusAluno::create($request->all());

        return redirect()->route('admin.meus-alunos.index');
    }

    public function edit(MeusAluno $meusAluno)
    {
        abort_if(Gate::denies('meus_aluno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meusAlunos.edit', compact('meusAluno'));
    }

    public function update(UpdateMeusAlunoRequest $request, MeusAluno $meusAluno)
    {
        $meusAluno->update($request->all());

        return redirect()->route('admin.meus-alunos.index');
    }

    public function show(MeusAluno $meusAluno)
    {
        abort_if(Gate::denies('meus_aluno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meusAlunos.show', compact('meusAluno'));
    }

    public function destroy(MeusAluno $meusAluno)
    {
        abort_if(Gate::denies('meus_aluno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meusAluno->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeusAlunoRequest $request)
    {
        MeusAluno::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
