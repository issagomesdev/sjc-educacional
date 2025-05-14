<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeuBoletimRequest;
use App\Http\Requests\StoreMeuBoletimRequest;
use App\Http\Requests\UpdateMeuBoletimRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeuBoletimController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('meu_boletim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuBoletims.index');
    }

    public function create()
    {
        abort_if(Gate::denies('meu_boletim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuBoletims.create');
    }

    public function store(StoreMeuBoletimRequest $request)
    {
        $meuBoletim = MeuBoletim::create($request->all());

        return redirect()->route('admin.meu-boletims.index');
    }

    public function edit(MeuBoletim $meuBoletim)
    {
        abort_if(Gate::denies('meu_boletim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuBoletims.edit', compact('meuBoletim'));
    }

    public function update(UpdateMeuBoletimRequest $request, MeuBoletim $meuBoletim)
    {
        $meuBoletim->update($request->all());

        return redirect()->route('admin.meu-boletims.index');
    }

    public function show(MeuBoletim $meuBoletim)
    {
        abort_if(Gate::denies('meu_boletim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuBoletims.show', compact('meuBoletim'));
    }

    public function destroy(MeuBoletim $meuBoletim)
    {
        abort_if(Gate::denies('meu_boletim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meuBoletim->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeuBoletimRequest $request)
    {
        MeuBoletim::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
