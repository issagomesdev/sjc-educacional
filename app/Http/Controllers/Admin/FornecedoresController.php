<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fornecedore;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FornecedoresController extends Controller
{
  public function index()
  {
      abort_if(Gate::denies('fornecedore_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $fornecedores = Fornecedore::with(['assinatura', 'team'])->get();

      $users = User::get();
      $teams = Team::get();

      return view('admin.fornecedores.index', compact('fornecedores', 'teams', 'users'));
  }

    public function create()
    {
        abort_if(Gate::denies('fornecedore_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fornecedores.create');
    }

    public function store(Request $request)
    {
        $fornecedore = Fornecedore::create($request->all());

        return redirect()->route('admin.fornecedores.index');
    }

    public function edit(Fornecedore $fornecedore)
    {
        abort_if(Gate::denies('fornecedore_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedore->load('assinatura', 'team');

        return view('admin.fornecedores.edit', compact('fornecedore'));
    }

    public function update(Request $request, Fornecedore $fornecedore)
    {
        $fornecedore->update($request->all());

        return redirect()->route('admin.fornecedores.index');
    }

    public function show(Fornecedore $fornecedore)
    {
        abort_if(Gate::denies('fornecedore_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedore->load('assinatura', 'team');

        return view('admin.fornecedores.show', compact('fornecedore'));
    }

    public function destroy(Fornecedore $fornecedore)
    {
        abort_if(Gate::denies('fornecedore_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fornecedore->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Fornecedore::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
