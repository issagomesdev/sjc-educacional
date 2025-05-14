<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInstalarRequest;
use App\Http\Requests\StoreInstalarRequest;
use App\Http\Requests\UpdateInstalarRequest;
use App\Models\Instalar;
use App\Models\Team;
use App\Models\TipoDeProfissional;
use App\Models\Profissionai;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstalarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('instalar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalars = Instalar::with(['instituicao', 'funcaos', 'profissional', 'assinatura', 'team'])->get();

        $teams = Team::get();

        $tipo_de_profissionals = TipoDeProfissional::get();

        $profissionals = Profissionai::get();

        return view('admin.instalars.index', compact('instalars', 'teams', 'tipo_de_profissionals', 'profissionals'));
    }

    public function create()
    {
        abort_if(Gate::denies('instalar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $funcaos = TipoDeProfissional::pluck('titulo', 'id');

        $profissionals = Profissionai::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instalars.create', compact('funcaos', 'instituicaos', 'profissionals'));
    }

    public function store(Request $request, Profissionai $profissional )
    {
      // dd($request->all());

      $ano = $request->ano;
      $id = $request->profissional_id;
      $instituicao = $request->instituicao_id;
      $funcaos = $request->funcaos;
      $assinatura = $request->assinatura_id;
      $team = $request->team_id;

        $profissionals = Profissionai::where('id', $id)->first();
        $profissionals->funcaos()->sync($request->input('funcaos', []));
        $profissionals->instituicao_id = $instituicao;
        $profissionals->save();

        $instalar = Instalar::create();
        $instalar->ano = $ano;
        $instalar->profissional_id = $id;
        $instalar->instituicao_id = $instituicao;
        $instalar->funcaos()->sync($request->input('funcaos', []));
        $instalar->assinatura_id = $assinatura;
        $instalar->team_id = $team;
        $instalar->save();


        return redirect()->route('admin.instalars.index');
    }

    public function edit(Instalar $instalar)
    {
        abort_if(Gate::denies('instalar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hierarquias = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profissionals = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instalar->load('hierarquia', 'profissional', 'instituicao', 'team', 'assinatura');

        return view('admin.instalars.edit', compact('hierarquias', 'profissionals', 'instituicaos', 'instalar'));
    }

    public function update(UpdateInstalarRequest $request, Instalar $instalar)
    {
        $instalar->update($request->all());

        return redirect()->route('admin.instalars.index');
    }

    public function show(Instalar $instalar)
    {
        abort_if(Gate::denies('instalar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalar->load('instituicao', 'funcaos', 'profissional', 'assinatura', 'team');

        return view('admin.instalars.show', compact('instalar'));
    }

    public function destroy(Instalar $instalar)
    {
        abort_if(Gate::denies('instalar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalar->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstalarRequest $request)
    {
        Instalar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
