<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCadastrarLivroRequest;
use App\Http\Requests\StoreCadastrarLivroRequest;
use App\Http\Requests\UpdateCadastrarLivroRequest;
use App\Models\EmprestimosEDevoluco;
use App\Models\CadastrarBiblioteca;
use App\Models\CadastrarLivro;
use App\Models\Materium;
use App\Models\Team;
use App\Models\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastrarLivroController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cadastrar_livro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarLivros = CadastrarLivro::with(['biblioteca', 'materias_relacionadas', 'team', 'assinatura'])->get();

        $cadastrar_bibliotecas = CadastrarBiblioteca::get();

        $materia = Materium::get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.cadastrarLivros.index', compact('cadastrarLivros', 'cadastrar_bibliotecas', 'materia', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('cadastrar_livro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bibliotecas = CadastrarBiblioteca::pluck('nome_da_biblioteca', 'id')->prepend(trans('global.pleaseSelect'), '');

        $materias_relacionadas = Materium::pluck('nome_da_materia', 'id');

        return view('admin.cadastrarLivros.create', compact('bibliotecas', 'materias_relacionadas'));
    }

    public function store(StoreCadastrarLivroRequest $request)
    {
        $cadastrarLivro = CadastrarLivro::create($request->all());
        $cadastrarLivro->materias_relacionadas()->sync($request->input('materias_relacionadas', []));

        return redirect()->route('admin.cadastrar-livros.index');
    }

    public function edit(CadastrarLivro $cadastrarLivro)
    {
        abort_if(Gate::denies('cadastrar_livro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bibliotecas = CadastrarBiblioteca::pluck('nome_da_biblioteca', 'id')->prepend(trans('global.pleaseSelect'), '');

        $materias_relacionadas = Materium::pluck('nome_da_materia', 'id');

        $cadastrarLivro->load('biblioteca', 'materias_relacionadas', 'team', 'assinatura');

        return view('admin.cadastrarLivros.edit', compact('bibliotecas', 'materias_relacionadas', 'cadastrarLivro'));
    }

    public function update(UpdateCadastrarLivroRequest $request, CadastrarLivro $cadastrarLivro)
    {
        $cadastrarLivro->update($request->all());
        $cadastrarLivro->materias_relacionadas()->sync($request->input('materias_relacionadas', []));

        return redirect()->route('admin.cadastrar-livros.index');
    }

    public function show(CadastrarLivro $cadastrarLivro)
    {
        abort_if(Gate::denies('cadastrar_livro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarLivro->load('biblioteca', 'materias_relacionadas', 'team', 'assinatura');
        $table = DB::table('cadastrar_livro_emprestimos_e_devoluco')
        ->where('cadastrar_livro_id', $cadastrarLivro->id)->pluck('emprestimos_e_devoluco_id');
        $emprestimosEDevolucos = EmprestimosEDevoluco::whereIn('id', $table)
        ->where('situacao', 'A devolver')
        ->orWhere('situacao', 'Prorrogado')
        ->orWhere('situacao', 'Atrasado')
        ->count();
        $exemplaresDisponiveis = $cadastrarLivro->exemplares_existentes - $emprestimosEDevolucos;


        return view('admin.cadastrarLivros.show', compact('cadastrarLivro', 'exemplaresDisponiveis'));
    }

    public function destroy(CadastrarLivro $cadastrarLivro)
    {
        abort_if(Gate::denies('cadastrar_livro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarLivro->delete();

        return back();
    }

    public function massDestroy(MassDestroyCadastrarLivroRequest $request)
    {
        CadastrarLivro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
