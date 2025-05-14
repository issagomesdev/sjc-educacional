<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Produto;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstoquesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estoque_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoques = Estoque::with(['assinatura', 'team'])->get();

        return view('admin.estoques.index', compact('estoques'));
    }

    public function create()
    {
        abort_if(Gate::denies('estoque_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estoques.create');
    }

    public function store(Request $request)
    {
        $estoque = Estoque::create($request->all());

        return redirect()->route('admin.estoques.index');
    }

    public function edit(Estoque $estoque)
    {
        abort_if(Gate::denies('estoque_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoque->load('assinatura', 'team');

        return view('admin.estoques.edit', compact('estoque'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $estoque->update($request->all());

        return redirect()->route('admin.estoques.index');
    }

    public function show(Estoque $estoque)
    {
        abort_if(Gate::denies('estoque_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoque->load('assinatura', 'team');
        $get = DB::table('produtos_no_estoque')->where('estoque_id', $estoque->id)->pluck('produto_id');
        $produtos_no_estoque = json_decode(json_encode($get), true);
        $produtos = Produto::whereIn('id', $produtos_no_estoque)->get();
        $get = DB::table('produtos_no_estoque')->where('estoque_id', $estoque->id)->get();
        $produtos_no_estoque = json_decode(json_encode($get), true);

        return view('admin.estoques.show', compact('estoque', 'produtos_no_estoque', 'produtos'));
    }

    public function destroy(Estoque $estoque)
    {
        abort_if(Gate::denies('estoque_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoque->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Estoque::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
