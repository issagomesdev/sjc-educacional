<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Fornecedore;
use App\Models\PedidosDeCompra;
use App\Models\Produto;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Support\Arr;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PedidosDeCompraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pedidos_de_compra_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pedidosDeCompras = PedidosDeCompra::with(['estoque', 'fornecedor', 'produto', 'assinatura', 'team'])->get();

        $estoques = Estoque::get();

        $fornecedores = Fornecedore::get();

        $produtos = Produto::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.pedidosDeCompras.index', compact('estoques', 'fornecedores', 'pedidosDeCompras', 'produtos', 'teams', 'users'));
    }

    public function situacao(Request $request)
    {
        abort_if(Gate::denies('requisico_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = $request->id;
        $pedidosDeCompras = PedidosDeCompra::where('id', $request->id)->get();
        $code_eval = $pedidosDeCompras->pluck('pedido')->toArray('0');
        eval("$". "pedidos=". "array(" .$code_eval['0']. ");");

        return view('admin.pedidosDeCompras.situacao', compact('id', 'pedidos', 'pedidosDeCompras'));
    }

    public function upSituacao(Request $request)
    {
        abort_if(Gate::denies('requisico_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());

        $pedidosDeCompras = PedidosDeCompra::where('id', $request->id)->update([
          'situacao' => $request->situacao
        ]);

        return redirect()->route('admin.pedidos-de-compras.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('pedidos_de_compra_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedors = Fornecedore::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estoque = $request->estoque;

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $estoque)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        return view('admin.pedidosDeCompras.create', compact('estoque', 'produtos_array', 'produtos_no_estoque', 'produtos', 'fornecedors'));
    }

    public function store(Request $request)
    {

      $produtos = implode(' ', $request->produtos);
      $pedidosDeCompra = PedidosDeCompra::create($request->all());
      $pedidosDeCompra->pedido = $produtos;
      $pedidosDeCompra->save();

        return redirect()->route('admin.pedidos-de-compras.index');
    }

    public function edit(PedidosDeCompra $pedidosDeCompra)
    {
        abort_if(Gate::denies('pedidos_de_compra_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedors = Fornecedore::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $pedidosDeCompra->estoque_id)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        eval( "$". "pedidos=". "array(" .$pedidosDeCompra->pedido. ");");

        $pedidosDeCompra->load('estoque', 'fornecedor', 'produto', 'assinatura', 'team');

        return view('admin.pedidosDeCompras.edit', compact('pedidos', 'produtos_array', 'produtos_no_estoque', 'produtos', 'fornecedors', 'pedidosDeCompra'));
    }

    public function update(Request $request, PedidosDeCompra $pedidosDeCompra)
    {
        $produtos = implode(' ', $request->produtos);
        $pedidosDeCompra->update($request->all());
        $pedidosDeCompra->pedido = $produtos;
        $pedidosDeCompra->save();

        return redirect()->route('admin.pedidos-de-compras.index');
    }

    public function show(PedidosDeCompra $pedidosDeCompra)
    {
        abort_if(Gate::denies('pedidos_de_compra_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pedidosDeCompra->load('estoque', 'fornecedor', 'produto', 'assinatura', 'team');

        eval( "$". "pedidos=". "array(" .$pedidosDeCompra->pedido. ");");

        return view('admin.pedidosDeCompras.show', compact('pedidosDeCompra', 'pedidos'));
    }

    public function destroy(PedidosDeCompra $pedidosDeCompra)
    {
        abort_if(Gate::denies('pedidos_de_compra_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pedidosDeCompra->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        PedidosDeCompra::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
