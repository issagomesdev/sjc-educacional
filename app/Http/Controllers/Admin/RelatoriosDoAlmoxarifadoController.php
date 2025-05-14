<?php

namespace App\Http\Controllers\Admin;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\Requisitante;
use App\Models\Fornecedore;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\EntradaNoEstoque;
use App\Models\CategoriasDeProduto;
use App\Models\SaidaNoEstoque;
use App\Models\Requisico;
use App\Models\PedidosDeCompra;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Gate;
use DB;

class RelatoriosDoAlmoxarifadoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.relatoriosDoAlmoxarifados.index');
    }

    public function fornecedores()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedores = Fornecedore::get();

        return view('admin.relatoriosDoAlmoxarifados.fornecedores', compact('fornecedores'));
    }

    public function requisitantes()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::get();

        return view('admin.relatoriosDoAlmoxarifados.requisitantes', compact('requisitantes'));
    }

    public function entradas()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entradas = EntradaNoEstoque::get();
        $estoques = Estoque::get();
        $produtos = Produto::get();
        $fornecedores = Fornecedore::get();

        return view('admin.relatoriosDoAlmoxarifados.entradas', compact('entradas', 'estoques', 'produtos', 'fornecedores'));
    }

    public function saidas()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidas = SaidaNoEstoque::get();
        $estoques = Estoque::get();
        $produtos = Produto::get();
        $requisitantes = Requisitante::get();

        return view('admin.relatoriosDoAlmoxarifados.saidas', compact('saidas', 'estoques', 'produtos', 'requisitantes'));
    }

    public function requisicos()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisicoes = Requisico::get();
        $estoques = Estoque::get();
        $requisitantes = Requisitante::get();

        return view('admin.relatoriosDoAlmoxarifados.requisicos', compact('requisicoes', 'estoques', 'requisitantes'));
    }

    public function pedidos()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pedidos = PedidosDeCompra::get();
        $estoques = Estoque::get();
        $fornecedores = Fornecedore::get();

        return view('admin.relatoriosDoAlmoxarifados.pedidos', compact('pedidos', 'estoques', 'fornecedores'));
    }

    public function produtos()
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produtos = Produto::get();
        $categorias_de_produtos = CategoriasDeProduto::get();
        $get = DB::table('produtos_no_estoque')->get();
        $produtos_no_estoque = json_decode(json_encode($get), true);
        $get_array = DB::table('produtos_no_estoque')->pluck('produto_id');
        $produtos_array = Arr::collapse([$get_array]);

        return view('admin.relatoriosDoAlmoxarifados.produtos', compact('produtos_array', 'categorias_de_produtos', 'produtos_no_estoque', 'produtos'));
    }

    public function estoques(Request $request)
    {
        abort_if(Gate::denies('relatorios_do_almoxarifado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produtos = Produto::get();
        $estoques = Estoque::get();
        $request_estoque = $request->estoque;
        $categorias_de_produtos = CategoriasDeProduto::get();

        $query = ''; $where = [];

        if($request_estoque != 'all'){ $where[] = "->where('estoque_id', ". $request_estoque . ")"; }

        if(count($where) > 0){ $wheres = implode("", $where); $query .= $wheres . ''; }

        eval("$" . "get = " . "DB::table('produtos_no_estoque')". $query.
        "->get();"."$" . "get_array = " . "DB::table('produtos_no_estoque')". $query."->pluck('produto_id');");
        
        $produtos_no_estoque = json_decode(json_encode($get), true);
        $produtos_array = Arr::collapse([$get_array]);

        return view('admin.relatoriosDoAlmoxarifados.estoques', compact('request_estoque', 'estoques', 'produtos_array', 'categorias_de_produtos', 'produtos_no_estoque', 'produtos'));
    }
}
