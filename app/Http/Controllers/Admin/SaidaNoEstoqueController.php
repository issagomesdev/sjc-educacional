<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Requisitante;
use App\Models\SaidaNoEstoque;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Support\Arr;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaidaNoEstoqueController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('saida_no_estoque_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidaNoEstoques = SaidaNoEstoque::with(['estoque', 'produto', 'requisitante', 'assinatura', 'team'])->get();

        $estoques = Estoque::get();

        $produtos = Produto::get();

        $requisitantes = Requisitante::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.saidaNoEstoques.index', compact('estoques', 'produtos', 'requisitantes', 'saidaNoEstoques', 'teams', 'users'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('saida_no_estoque_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estoque = $request->estoque;

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $estoque)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        return view('admin.saidaNoEstoques.create', compact('estoque', 'produtos_array', 'produtos_no_estoque', 'produtos', 'requisitantes'));
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

      if (!in_array($request->produto_id, $produtos_no_estoque)) {

          return redirect()->route('admin.saida-no-estoques.create', ['estoque' => $request->estoque_id])
          ->with('message', 'o produto selecionado não existe dentro do estoque selecionado, refaça suas seleções ou realize uma entrada de estoque primeiro.');

      } else{

      if($quantidade_atual['0'] < $request->quatidade) {

        return redirect()->route('admin.saida-no-estoques.create', ['estoque' => $request->estoque_id])
        ->with('message', 'a quantidade informada do produto selecionado é maior que a quatidade atual deste dentro do estoque selecionado, refaça suas seleções ou realize uma entrada de estoque primeiro.');

      }

      else {

        $quantidade = $quantidade_atual['0'] - $request->quatidade;

              DB::table('produtos_no_estoque')
              ->where('estoque_id', $request->estoque_id)
              ->where('produto_id', $request->produto_id)
              ->update([
                'quantidade' => $quantidade
              ]);

              $saidaNoEstoque = SaidaNoEstoque::create($request->all());

                  return redirect()->route('admin.saida-no-estoques.index');

            }

         }
    }

    public function edit(SaidaNoEstoque $saidaNoEstoque)
    {
        abort_if(Gate::denies('saida_no_estoque_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitantes = Requisitante::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $saidaNoEstoque->load('estoque', 'produto', 'requisitante', 'assinatura', 'team');

        $get = DB::table('produtos_no_estoque')->get()->toArray();

        $produtos_no_estoque = json_decode(json_encode($get), true);

        $get_array = DB::table('produtos_no_estoque')->where('estoque_id', $saidaNoEstoque->estoque_id)->pluck('produto_id');

        $produtos_array = Arr::collapse([$get_array]);

        $produtos = Produto::get();

        return view('admin.saidaNoEstoques.edit', compact('produtos_array', 'produtos_no_estoque', 'produtos', 'requisitantes', 'saidaNoEstoque'));
    }

    public function update(Request $request, SaidaNoEstoque $saidaNoEstoque)
    {

      $get_table = DB::table('produtos_no_estoque')->where('estoque_id', $saidaNoEstoque->estoque_id)->pluck('produto_id');
      $produtos_no_estoque = Arr::collapse([$get_table]);

      $get_quantidade = DB::table('produtos_no_estoque')
      ->where('estoque_id', $saidaNoEstoque->estoque_id)
      ->where('produto_id', $request->produto_id)
      ->pluck('quantidade');

      $quantidade_atual = Arr::collapse([$get_quantidade]);

      if (!in_array($request->produto_id, $produtos_no_estoque)) {

        $saidaNoEstoque->update([
          'requisitante_id' => $request->requisitante_id
        ]);

          return redirect()->route('admin.saida-no-estoques.index')
          ->with('message', 'o produto selecionado não existe dentro do estoque selecionado, refaça suas seleções ou realize uma entrada de estoque primeiro, requisitante atualizado, apenas.');

      } else{

      if($quantidade_atual['0'] < $request->quatidade) {

        $saidaNoEstoque->update([
          'requisitante_id' => $request->requisitante_id
        ]);

        return redirect()->route('admin.saida-no-estoques.index')
        ->with('message', 'a quantidade informada do produto selecionado é maior que a quatidade atual deste dentro do estoque selecionado, refaça suas seleções ou realize uma entrada de estoque primeiro, requisitante atualizado, apenas.');

      }

      else {

        //

        $get_quantidade = DB::table('produtos_no_estoque')
        ->where('estoque_id', $saidaNoEstoque->estoque_id)
        ->where('produto_id', $saidaNoEstoque->produto_id)
        ->pluck('quantidade');

        $quantidade_atual = Arr::collapse([$get_quantidade]);
        $quantidade = $quantidade_atual['0'] + $saidaNoEstoque->quatidade;

        DB::table('produtos_no_estoque')
        ->where('estoque_id', $saidaNoEstoque->estoque_id)
        ->where('produto_id', $saidaNoEstoque->produto_id)
        ->update([
          'quantidade' => $quantidade
        ]);

        //

        $get_quantidade2 = DB::table('produtos_no_estoque')
        ->where('estoque_id', $saidaNoEstoque->estoque_id)
        ->where('produto_id', $request->produto_id)
        ->pluck('quantidade');

        $quantidade_atual2 = Arr::collapse([$get_quantidade2]);

        $nova_quantidade = $quantidade_atual2['0'] - $request->quatidade;

              DB::table('produtos_no_estoque')
              ->where('estoque_id', $saidaNoEstoque->estoque_id)
              ->where('produto_id', $request->produto_id)
              ->update([
                'quantidade' => $nova_quantidade
              ]);

              $saidaNoEstoque->update($request->all());

              return redirect()->route('admin.saida-no-estoques.index');

            }

         }

    }

    public function show(SaidaNoEstoque $saidaNoEstoque)
    {
        abort_if(Gate::denies('saida_no_estoque_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidaNoEstoque->load('estoque', 'produto', 'requisitante', 'assinatura', 'team');

        return view('admin.saidaNoEstoques.show', compact('saidaNoEstoque'));
    }

    public function destroy(SaidaNoEstoque $saidaNoEstoque)
    {
        abort_if(Gate::denies('saida_no_estoque_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidaNoEstoque->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        SaidaNoEstoque::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
