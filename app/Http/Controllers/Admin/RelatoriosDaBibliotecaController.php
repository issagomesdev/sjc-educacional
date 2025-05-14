<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CadastrarBiblioteca;
use App\Models\Materium;
use App\Models\UsuariosDaBiblioteca;
use App\Models\EmprestimosEDevoluco;
use App\Models\CadastrarLivro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RelatoriosDaBibliotecaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('relatorios_da_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.relatoriosDaBibliotecas.index');
    }

    public function livros()
    {
        abort_if(Gate::denies('relatorios_da_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $livros = CadastrarLivro::with(['biblioteca', 'materias_relacionadas', 'team', 'assinatura'])->get();

        $bibliotecas = CadastrarBiblioteca::get();

        $materias = Materium::get();

        return view('admin.relatoriosDaBibliotecas.livros', compact('livros', 'bibliotecas', 'materias'));
    }

    public function users()
    {
        abort_if(Gate::denies('relatorios_da_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = UsuariosDaBiblioteca::get();

        return view('admin.relatoriosDaBibliotecas.users', compact('users'));
    }

    public function emprestimos()
    {
        abort_if(Gate::denies('relatorios_da_biblioteca_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emprestimos = EmprestimosEDevoluco::with(['usuario_da_biblioteca', 'biblioteca', 'livros', 'assinatura', 'team'])->get();

        $usuarios_da_bibliotecas = UsuariosDaBiblioteca::get();

        $cadastrar_bibliotecas = CadastrarBiblioteca::get();

        $cadastrar_livros = CadastrarLivro::get();

        return view('admin.relatoriosDaBibliotecas.emprestimos', compact('emprestimos', 'usuarios_da_bibliotecas', 'cadastrar_bibliotecas', 'cadastrar_livros'));
    }

}
