<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipoDeProfissionalRequest;
use App\Http\Requests\StoreTipoDeProfissionalRequest;
use App\Http\Requests\UpdateTipoDeProfissionalRequest;
use App\Models\TipoDeProfissional;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoDeProfissionalController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_de_profissional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoDeProfissionals = TipoDeProfissional::with(['assinatura', 'team'])->get();

        return view('admin.tipoDeProfissionals.index', compact('tipoDeProfissionals'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipo_de_profissional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoDeProfissionals.create');
    }

    public function store(StoreTipoDeProfissionalRequest $request)
    {
        $tipoDeProfissional = TipoDeProfissional::create($request->all());

        return redirect()->route('admin.tipo-de-profissionals.index');
    }

    public function edit(TipoDeProfissional $tipoDeProfissional)
    {
        abort_if(Gate::denies('tipo_de_profissional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoDeProfissional->load('assinatura', 'team');

        return view('admin.tipoDeProfissionals.edit', compact('tipoDeProfissional'));
    }

    public function update(UpdateTipoDeProfissionalRequest $request, TipoDeProfissional $tipoDeProfissional)
    {
        $tipoDeProfissional->update($request->all());

        return redirect()->route('admin.tipo-de-profissionals.index');
    }

    public function show(TipoDeProfissional $tipoDeProfissional)
    {
        abort_if(Gate::denies('tipo_de_profissional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoDeProfissional->load('assinatura', 'team', 'funcaoProfissionais');

        return view('admin.tipoDeProfissionals.show', compact('tipoDeProfissional'));
    }

    public function destroy(TipoDeProfissional $tipoDeProfissional)
    {
        abort_if(Gate::denies('tipo_de_profissional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoDeProfissional->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoDeProfissionalRequest $request)
    {
        TipoDeProfissional::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
