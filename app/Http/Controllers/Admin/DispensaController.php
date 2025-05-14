<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDispensaRequest;
use App\Http\Requests\StoreDispensaRequest;
use App\Http\Requests\UpdateDispensaRequest;
use App\Models\Cadastro;
use App\Models\Dispensa;
use App\Models\Materium;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DispensaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dispensa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dispensas = Dispensa::with(['disciplinas', 'escola', 'turma', 'alunos', 'team', 'assinatura'])->get();

        $materia = Materium::get();

        $teams = Team::get();

        $turmas = Turma::get();

        $cadastros = Cadastro::get();

        $users = User::get();

        return view('admin.dispensas.index', compact('dispensas', 'materia', 'teams', 'turmas', 'cadastros', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('dispensa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $alunos = Cadastro::pluck('nome_completo', 'id');

        return view('admin.dispensas.create', compact('auth', 'disciplinas', 'escolas', 'turmas', 'alunos'));
    }

    public function store(StoreDispensaRequest $request)
    {
        $dispensa = Dispensa::create($request->all());
        $dispensa->disciplinas()->sync($request->input('disciplinas', []));
        $dispensa->alunos()->sync($request->input('alunos', []));

        return redirect()->route('admin.dispensas.index');
    }

    public function edit(Dispensa $dispensa)
    {
        abort_if(Gate::denies('dispensa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $alunos = Cadastro::pluck('nome_completo', 'id');

        $dispensa->load('disciplinas', 'escola', 'turma', 'alunos', 'team', 'assinatura');

        return view('admin.dispensas.edit', compact('auth', 'disciplinas', 'escolas', 'turmas', 'alunos', 'dispensa'));
    }

    public function update(UpdateDispensaRequest $request, Dispensa $dispensa)
    {
        $dispensa->update($request->all());
        $dispensa->disciplinas()->sync($request->input('disciplinas', []));
        $dispensa->alunos()->sync($request->input('alunos', []));

        return redirect()->route('admin.dispensas.index');
    }

    public function show(Dispensa $dispensa)
    {
        abort_if(Gate::denies('dispensa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dispensa->load('disciplinas', 'escola', 'turma', 'alunos', 'team', 'assinatura');

        return view('admin.dispensas.show', compact('dispensa'));
    }

    public function destroy(Dispensa $dispensa)
    {
        abort_if(Gate::denies('dispensa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dispensa->delete();

        return back();
    }

    public function massDestroy(MassDestroyDispensaRequest $request)
    {
        Dispensa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
