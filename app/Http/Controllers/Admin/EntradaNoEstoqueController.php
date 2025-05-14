<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntradaNoEstoqueRequest;
use App\Http\Requests\StoreEntradaNoEstoqueRequest;
use App\Http\Requests\UpdateEntradaNoEstoqueRequest;
use App\Models\EntradaNoEstoque;
use Illuminate\Support\Arr;
use App\Models\Estoque;
use App\Models\Fornecedore;
use App\Models\Produto;
use App\Models\Team;
use App\Models\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntradaNoEstoqueController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entrada_no_estoque_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entradaNoEstoques = EntradaNoEstoque::with(['estoque', 'produto', 'fornecedor', 'assinatura', 'team'])->get();

        $estoques = Estoque::get();

        $produtos = Produto::get();

        $fornecedores = Fornecedore::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.entradaNoEstoques.index', compact('entradaNoEstoques', 'estoques', 'fornecedores', 'produtos', 'teams', 'users'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('entrada_no_estoque_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estoque = $request->estoque;

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $estoque)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        $fornecedors = Fornecedore::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entradaNoEstoques.create', compact('estoque', 'produtos_array', 'produtos_no_estoque', 'fornecedors', 'produtos'));
    }

    public function store(Request $request)
    {

      $get_table = DB::table('produtos_no_estoque')->where('estoque_id', $request->estoque_id)->pluck('produto_id');
      $produtos_no_estoque = Arr::collapse([$get_table]);

      $get_quantidade = DB::table('produtos_no_estoque')
      ->where('estoque_id', $request->estoque_id)
      ->where('produto_id', $request->produto_id)
      ->pluck('quantidade');

      $quantidade_atual = Arr::collapse([$get_quantidade]);

      if (in_array($request->produto_id, $produtos_no_estoque)) {

        $quantidade = $request->quatidade + $quantidade_atual['0'];

            DB::table('produtos_no_estoque')
            ->where('estoque_id', $request->estoque_id)
            ->where('produto_id', $request->produto_id)
            ->update([
              'quantidade' => $quantidade
            ]);

          } else {

            DB::table('produtos_no_estoque')
            ->insert([
              'estoque_id' =>  $request->estoque_id,
              'produto_id' => $request->produto_id,
              'quantidade' => $request->quatidade
            ]);
          }

        $entradaNoEstoque = EntradaNoEstoque::create($request->all());

        return redirect()->route('admin.entrada-no-estoques.index');
    }

    public function edit(EntradaNoEstoque $entradaNoEstoque)
    {
        abort_if(Gate::denies('entrada_no_estoque_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $entradaNoEstoque->estoque_id)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        $fornecedors = Fornecedore::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entradaNoEstoque->load('estoque', 'produto', 'fornecedor', 'assinatura', 'team');

        return view('admin.entradaNoEstoques.edit', compact('entradaNoEstoque', 'produtos_array', 'produtos_no_estoque', 'fornecedors', 'produtos'));
    }

    public function update(Request $request, EntradaNoEstoque $entradaNoEstoque)
    {

      // desfazer

      $get_quantidade = DB::table('produtos_no_estoque')
      ->where('estoque_id', $entradaNoEstoque->estoque_id)
      ->where('produto_id', $entradaNoEstoque->produto_id)
      ->pluck('quantidade');

      $quantidade_atual = Arr::collapse([$get_quantidade]);
      $quantidade = $quantidade_atual['0'] - $entradaNoEstoque->quatidade;

      DB::table('produtos_no_estoque')
      ->where('estoque_id', $entradaNoEstoque->estoque_id)
      ->where('produto_id', $entradaNoEstoque->produto_id)
      ->update([
        'quantidade' => $quantidade
      ]);

 //atualizar

 $get_table2 = DB::table('produtos_no_estoque')->where('estoque_id', $entradaNoEstoque->estoque_id)->pluck('produto_id');
 $produtos_no_estoque2 = Arr::collapse([$get_table2]);

 $get_quantidade2 = DB::table('produtos_no_estoque')
 ->where('estoque_id', $entradaNoEstoque->estoque_id)
 ->where('produto_id', $request->produto_id)
 ->pluck('quantidade');

 $quantidade_atual2 = Arr::collapse([$get_quantidade2]);

 if (in_array($request->produto_id, $produtos_no_estoque2)) {

    $quantidade2 = $request->quatidade + $quantidade_atual2['0'];

       DB::table('produtos_no_estoque')
       ->where('estoque_id', $entradaNoEstoque->estoque_id)
       ->where('produto_id', $request->produto_id)
       ->update([
         'quantidade' => $quantidade2
       ]);

     } else {

       DB::table('produtos_no_estoque')
       ->insert([
         'estoque_id' =>  $entradaNoEstoque->estoque_id,
         'produto_id' => $request->produto_id,
         'quantidade' => $request->quatidade
       ]);
     }

        $entradaNoEstoque->update($request->all());

        return redirect()->route('admin.entrada-no-estoques.index');
    }

    public function show(EntradaNoEstoque $entradaNoEstoque)
    {
        abort_if(Gate::denies('entrada_no_estoque_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entradaNoEstoque->load('estoque', 'produto', 'fornecedor', 'assinatura', 'team');

        return view('admin.entradaNoEstoques.show', compact('entradaNoEstoque'));
    }

    public function destroy(EntradaNoEstoque $entradaNoEstoque)
    {
        abort_if(Gate::denies('entrada_no_estoque_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entradaNoEstoque->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        EntradaNoEstoque::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
