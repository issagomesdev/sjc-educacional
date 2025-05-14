<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTeamTypeRequest;
use App\Http\Requests\StoreTeamTypeRequest;
use App\Http\Requests\UpdateTeamTypeRequest;
use App\Models\TeamType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamTypes = TeamType::with(['assinatura', 'team'])->get();

        return view('admin.teamTypes.index', compact('teamTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('team_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.teamTypes.create');
    }

    public function store(StoreTeamTypeRequest $request)
    {
        $teamType = TeamType::create($request->all());

        return redirect()->route('admin.team-types.index');
    }

    public function edit(TeamType $teamType)
    {
        abort_if(Gate::denies('team_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamType->load('assinatura', 'team');

        return view('admin.teamTypes.edit', compact('teamType'));
    }

    public function update(UpdateTeamTypeRequest $request, TeamType $teamType)
    {
        $teamType->update($request->all());

        return redirect()->route('admin.team-types.index');
    }

    public function show(TeamType $teamType)
    {
        abort_if(Gate::denies('team_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamType->load('assinatura', 'team');

        return view('admin.teamTypes.show', compact('teamType'));
    }

    public function destroy(TeamType $teamType)
    {
        abort_if(Gate::denies('team_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamTypeRequest $request)
    {
        TeamType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
