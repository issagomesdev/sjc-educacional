<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Models\TeamType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::with(['tipo_de_instituicao', 'owner', 'assinatura'])->get();

        $team_types = TeamType::get();

        $users = User::get();

        return view('admin.teams.index', compact('team_types', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('team_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_de_instituicaos = TeamType::pluck('titulo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teams.create', compact('owners', 'tipo_de_instituicaos'));
    }

    public function store(StoreTeamRequest $request)
    {
        $data             = $request->all();
        $data['owner_id'] = auth()->user()->id;
        $team             = Team::create($data);

        return redirect()->route('admin.teams.index');
    }

    public function edit(Team $team)
    {
        abort_if(Gate::denies('team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_de_instituicaos = TeamType::pluck('titulo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team->load('tipo_de_instituicao', 'owner', 'assinatura');

        return view('admin.teams.edit', compact('owners', 'team', 'tipo_de_instituicaos'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return redirect()->route('admin.teams.index');
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->load('tipo_de_instituicao', 'owner', 'assinatura', 'teamCadastros', 'escolaTurmas', 'teamPresencaEletivas', 'escolaPresencaEletivas', 'escolaTransferencia', 'escolaMatriculas', 'instituicaoInstalars', 'escolaRematriculas', 'escolaNota', 'instituicaoProfissionais', 'escolasSemaulas');

        return view('admin.teams.show', compact('team'));
    }

    public function destroy(Team $team)
    {
        abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamRequest $request)
    {
        Team::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
