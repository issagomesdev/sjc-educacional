<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriasDeProduto;
use App\Models\Produto;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdutosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('produto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produtos = Produto::with(['categorias', 'assinatura', 'team'])->get();

        $categorias_de_produtos = CategoriasDeProduto::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.produtos.index', compact('categorias_de_produtos', 'produtos', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('produto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categorias = CategoriasDeProduto::pluck('titulo', 'id');

        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        $produto->categorias()->sync($request->input('categorias', []));

        return redirect()->route('admin.produtos.index');
    }

    public function edit(Produto $produto)
    {
        abort_if(Gate::denies('produto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categorias = CategoriasDeProduto::pluck('titulo', 'id');

        $produto->load('categorias', 'assinatura', 'team');

        return view('admin.produtos.edit', compact('categorias', 'produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        $produto->categorias()->sync($request->input('categorias', []));

        return redirect()->route('admin.produtos.index');
    }

    public function show(Produto $produto)
    {
        abort_if(Gate::denies('produto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produto->load('categorias', 'assinatura', 'team');

        return view('admin.produtos.show', compact('produto'));
    }

    public function destroy(Produto $produto)
    {
        abort_if(Gate::denies('produto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produto->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Produto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
