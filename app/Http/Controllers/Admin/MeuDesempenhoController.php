<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeuDesempenhoRequest;
use App\Http\Requests\StoreMeuDesempenhoRequest;
use App\Http\Requests\UpdateMeuDesempenhoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeuDesempenhoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('meu_desempenho_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuDesempenhos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('meu_desempenho_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuDesempenhos.create');
    }

    public function store(StoreMeuDesempenhoRequest $request)
    {
        $meuDesempenho = MeuDesempenho::create($request->all());

        return redirect()->route('admin.meu-desempenhos.index');
    }

    public function edit(MeuDesempenho $meuDesempenho)
    {
        abort_if(Gate::denies('meu_desempenho_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuDesempenhos.edit', compact('meuDesempenho'));
    }

    public function update(UpdateMeuDesempenhoRequest $request, MeuDesempenho $meuDesempenho)
    {
        $meuDesempenho->update($request->all());

        return redirect()->route('admin.meu-desempenhos.index');
    }

    public function show(MeuDesempenho $meuDesempenho)
    {
        abort_if(Gate::denies('meu_desempenho_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.meuDesempenhos.show', compact('meuDesempenho'));
    }

    public function destroy(MeuDesempenho $meuDesempenho)
    {
        abort_if(Gate::denies('meu_desempenho_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meuDesempenho->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeuDesempenhoRequest $request)
    {
        MeuDesempenho::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
