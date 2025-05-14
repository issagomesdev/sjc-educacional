<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CadastrarBiblioteca;
use App\Models\CadastrarLivro;
use App\Models\EmprestimosEDevoluco;
use App\Models\Team;
use App\Models\User;
use App\Models\UsuariosDaBiblioteca;
use Gate;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmprestimosEDevolucoesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emprestimosEDevolucos = EmprestimosEDevoluco::with(['usuario_da_biblioteca', 'biblioteca', 'livros', 'assinatura', 'team'])->get();

        $usuarios_da_bibliotecas = UsuariosDaBiblioteca::get();

        $cadastrar_bibliotecas = CadastrarBiblioteca::get();

        $cadastrar_livros = CadastrarLivro::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.emprestimosEDevolucos.index', compact('cadastrar_bibliotecas', 'cadastrar_livros', 'emprestimosEDevolucos', 'teams', 'users', 'usuarios_da_bibliotecas'));
    }

    public function situacao(Request $request)
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_up'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = $request->id;
        $emprestimosEDevolucos = EmprestimosEDevoluco::where('id', $request->id)->get();

        return view('admin.emprestimosEDevolucos.situacao', compact('emprestimosEDevolucos', 'id'));
    }

    public function upSituacao(Request $request)
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_up'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->situacao == 'Prorrogado') {
          $emprestimosEDevolucos = EmprestimosEDevoluco::where('id', $request->id)->update([
          'situacao' => $request->situacao,
          'data_de_devolucao' => Carbon::today()->addDays(7)->format('Y-m-d')
        ]);
        }

        else {
          $emprestimosEDevolucos = EmprestimosEDevoluco::where('id', $request->id)->update([
          'situacao' => $request->situacao
        ]);
        }

        return redirect()->route('admin.emprestimos-e-devolucos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuario_da_bibliotecas = UsuariosDaBiblioteca::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bibliotecas = CadastrarBiblioteca::pluck('nome_da_biblioteca', 'id')->prepend(trans('global.pleaseSelect'), '');

        $livros = CadastrarLivro::get();

        return view('admin.emprestimosEDevolucos.create', compact('bibliotecas', 'livros', 'usuario_da_bibliotecas'));
    }

    public function store(Request $request)
    {
        $emprestimosEDevoluco = EmprestimosEDevoluco::create($request->all());
        $emprestimosEDevoluco->data_de_devolucao = Carbon::today()->addDays(7)->format('Y-m-d');
        $emprestimosEDevoluco->save();
        $emprestimosEDevoluco->livros()->sync($request->input('livros', []));

        return redirect()->route('admin.emprestimos-e-devolucos.index');
    }

    public function edit(EmprestimosEDevoluco $emprestimosEDevoluco)
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuario_da_bibliotecas = UsuariosDaBiblioteca::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bibliotecas = CadastrarBiblioteca::pluck('nome_da_biblioteca', 'id')->prepend(trans('global.pleaseSelect'), '');

        $livros = CadastrarLivro::get();

        $emprestimosEDevoluco->load('usuario_da_biblioteca', 'biblioteca', 'livros', 'assinatura', 'team');

        return view('admin.emprestimosEDevolucos.edit', compact('bibliotecas', 'emprestimosEDevoluco', 'livros', 'usuario_da_bibliotecas'));
    }

    public function update(Request $request, EmprestimosEDevoluco $emprestimosEDevoluco)
    {
        $emprestimosEDevoluco->update($request->all());
        $emprestimosEDevoluco->livros()->sync($request->input('livros', []));

        return redirect()->route('admin.emprestimos-e-devolucos.index');
    }

    public function show(EmprestimosEDevoluco $emprestimosEDevoluco)
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emprestimosEDevoluco->load('usuario_da_biblioteca', 'biblioteca', 'livros', 'assinatura', 'team');

        return view('admin.emprestimosEDevolucos.show', compact('emprestimosEDevoluco'));
    }

    public function destroy(EmprestimosEDevoluco $emprestimosEDevoluco)
    {
        abort_if(Gate::denies('emprestimos_e_devoluco_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emprestimosEDevoluco->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        EmprestimosEDevoluco::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
