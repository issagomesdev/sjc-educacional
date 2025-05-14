<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDeslocarRequest;
use App\Http\Requests\StoreDeslocarRequest;
use App\Http\Requests\UpdateDeslocarRequest;
use App\Models\Deslocar;
use App\Models\Team;
use App\Models\User;
use App\Models\TipoDeProfissional;
use App\Models\Profissionai;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeslocarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('deslocar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deslocars = Deslocar::with(['institucao_1', 'profissional', 'institucao_2', 'assinatura', 'team'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.deslocars.index', compact('deslocars', 'teams', 'users'));
    }

    public function instituicao()
    {

        abort_if(Gate::denies('deslocar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicao = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.deslocars.instituicao', compact( 'instituicao'));
    }

    public function create(Request $request)
    {

    abort_if(Gate::denies('deslocar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $instituicao = $request->institucao_1;

    $institucao_1s = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

    $profissionals = Profissionai::where('instituicao_id', $instituicao)->pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

    $institucao_2s = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

    return view('admin.deslocars.create', compact('instituicao', 'institucao_1s', 'institucao_2s', 'profissionals'));
}



    public function store(Request $request)
    {
      // dd($request->all());

      $ano = $request->ano;
      $id = $request->profissional_id;
      $instituicao = $request->instituicao;
      $instituicao2 = $request->institucao_2_id;
      $assinatura = $request->assinatura_id;
      $team = $request->team_id;

        $profissionals = Profissionai::where('id', $id)->first();
        $profissionals->instituicao_id = $instituicao2;
        $profissionals->funcaos()->sync(0);
        $profissionals->save();

        $deslocar = Deslocar::create();
        $deslocar->ano = $ano;
        $deslocar->profissional_id = $id;
        $deslocar->institucao_1_id = $instituicao;
        $deslocar->institucao_2_id = $instituicao2;
        $deslocar->assinatura_id = $assinatura;
        $deslocar->team_id = $team;
        $deslocar->save();


        return redirect()->route('admin.deslocars.index');
    }

    public function edit(Deslocar $deslocar)
    {
        abort_if(Gate::denies('deslocar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicao_anteriors = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hierarquias = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profissionals = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $deslocar->load('instituicao_anterior', 'hierarquia', 'profissional', 'instituicao', 'team', 'assinatura');

        return view('admin.deslocars.edit', compact('instituicao_anteriors', 'hierarquias', 'profissionals', 'instituicaos', 'deslocar'));
    }

    public function update(UpdateDeslocarRequest $request, Deslocar $deslocar)
    {
        $deslocar->update($request->all());

        return redirect()->route('admin.deslocars.index');
    }

    public function show(Deslocar $deslocar)
    {
        abort_if(Gate::denies('deslocar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deslocar->load('institucao_1', 'profissional', 'institucao_2', 'assinatura', 'team');

        return view('admin.deslocars.show', compact('deslocar'));
    }

    public function destroy(Deslocar $deslocar)
    {
        abort_if(Gate::denies('deslocar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deslocar->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeslocarRequest $request)
    {
        Deslocar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
