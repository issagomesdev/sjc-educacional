<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Requisico;
use App\Models\Requisitante;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Support\Arr;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisicoesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('requisico_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisicos = Requisico::with(['estoque', 'requisitantes', 'produto', 'assinatura', 'team'])->get();

        $estoques = Estoque::get();

        $requisitantes = Requisitante::get();

        $produtos = Produto::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.requisicos.index', compact('estoques', 'produtos', 'requisicos', 'requisitantes', 'teams', 'users'));
    }

    public function situacao(Request $request)
    {
        abort_if(Gate::denies('requisico_up'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = $request->id;
        $requisico = Requisico::where('id', $request->id)->get();
        $code_eval = $requisico->pluck('pedido')->toArray('0');
        eval("$". "pedidos=". "array(" .$code_eval['0']. ");");

        return view('admin.requisicos.situacao', compact('id', 'pedidos', 'requisico'));
    }

    public function upSituacao(Request $request)
    {
        abort_if(Gate::denies('requisico_up'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());

        $requisico = Requisico::where('id', $request->id)->update([
          'situacao' => $request->situacao
        ]);

        return redirect()->route('admin.requisicos.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('requisico_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estoque = $request->estoque;

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $estoque)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        return view('admin.requisicos.create', compact('estoque', 'produtos_array', 'produtos_no_estoque', 'produtos', 'requisitantes'));
    }

    public function store(Request $request)
    {

        $produtos = implode(' ', $request->produtos);
        $requisico = Requisico::create($request->all());
        $requisico->pedido = $produtos;
        $requisico->save();

        return redirect()->route('admin.requisicos.index');
    }

    public function edit(Requisico $requisico)
    {
        abort_if(Gate::denies('requisico_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $requisico->estoque_id)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        eval( "$". "pedidos=". "array(" .$requisico->pedido. ");");

        $requisico->load('estoque', 'requisitantes', 'produto', 'assinatura', 'team');

        return view('admin.requisicos.edit', compact('pedidos', 'produtos_array', 'produtos_no_estoque', 'produtos', 'requisico', 'requisitantes'));
    }

    public function update(Request $request, Requisico $requisico)
    {
        $produtos = implode(' ', $request->produtos);
        $requisico->update($request->all());
        $requisico->pedido = $produtos;
        $requisico->save();

        return redirect()->route('admin.requisicos.index');
    }

    public function show(Requisico $requisico)
    {
        abort_if(Gate::denies('requisico_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisico->load('estoque', 'requisitantes', 'produto', 'assinatura', 'team');

        eval( "$". "pedidos=". "array(" .$requisico->pedido. ");");

        return view('admin.requisicos.show', compact('pedidos', 'requisico'));
    }

    public function destroy(Requisico $requisico)
    {
        abort_if(Gate::denies('requisico_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisico->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Requisico::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
