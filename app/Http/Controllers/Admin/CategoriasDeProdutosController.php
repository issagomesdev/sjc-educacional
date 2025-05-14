<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriasDeProduto;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriasDeProdutosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('categorias_de_produto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoriasDeProdutos = CategoriasDeProduto::with(['assinatura', 'team'])->get();

        return view('admin.categoriasDeProdutos.index', compact('categoriasDeProdutos'));
    }

    public function create()
    {
        abort_if(Gate::denies('categorias_de_produto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoriasDeProdutos.create');
    }

    public function store(Request $request)
    {
        $categoriasDeProduto = CategoriasDeProduto::create($request->all());

        return redirect()->route('admin.categorias-de-produtos.index');
    }

    public function edit(CategoriasDeProduto $categoriasDeProduto)
    {
        abort_if(Gate::denies('categorias_de_produto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoriasDeProduto->load('assinatura', 'team');

        return view('admin.categoriasDeProdutos.edit', compact('categoriasDeProduto'));
    }

    public function update(Request $request, CategoriasDeProduto $categoriasDeProduto)
    {
        $categoriasDeProduto->update($request->all());

        return redirect()->route('admin.categorias-de-produtos.index');
    }

    public function show(CategoriasDeProduto $categoriasDeProduto)
    {
        abort_if(Gate::denies('categorias_de_produto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoriasDeProduto->load('assinatura', 'team');

        return view('admin.categoriasDeProdutos.show', compact('categoriasDeProduto'));
    }

    public function destroy(CategoriasDeProduto $categoriasDeProduto)
    {
        abort_if(Gate::denies('categorias_de_produto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoriasDeProduto->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        CategoriasDeProduto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
