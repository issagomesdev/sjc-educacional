<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDesempenhoRequest;
use App\Http\Requests\StoreDesempenhoRequest;
use App\Http\Requests\UpdateDesempenhoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DesempenhoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('desempenho_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desempenhos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('desempenho_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desempenhos.create');
    }

    public function store(StoreDesempenhoRequest $request)
    {
        $desempenho = Desempenho::create($request->all());

        return redirect()->route('admin.desempenhos.index');
    }

    public function edit(Desempenho $desempenho)
    {
        abort_if(Gate::denies('desempenho_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desempenhos.edit', compact('desempenho'));
    }

    public function update(UpdateDesempenhoRequest $request, Desempenho $desempenho)
    {
        $desempenho->update($request->all());

        return redirect()->route('admin.desempenhos.index');
    }

    public function show(Desempenho $desempenho)
    {
        abort_if(Gate::denies('desempenho_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desempenhos.show', compact('desempenho'));
    }

    public function destroy(Desempenho $desempenho)
    {
        abort_if(Gate::denies('desempenho_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $desempenho->delete();

        return back();
    }

    public function massDestroy(MassDestroyDesempenhoRequest $request)
    {
        Desempenho::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
