<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBoletinRequest;
use App\Http\Requests\StoreBoletinRequest;
use App\Http\Requests\UpdateBoletinRequest;
use App\Models\Team;
use App\Models\Turma;
use App\Models\Notum;
use App\Models\Materium;
use App\Models\ResultadoFinal;
use App\Models\AbrirEEncerrarAnoLetivo;
use App\Models\PresencaEletiva;
use App\Models\Cadastro;
use PDF;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoletinsController extends Controller
{

  public function pdf(request $request)
  {

    $pdf = PDF::loadView('admin.boletins.view');

        return $pdf->stream('pdf-file.pdf');

  }

    public function index(request $request)
    {
        abort_if(Gate::denies('boletin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());
        $request_escola = $request->escola;
        $request_turma = $request->turma;
        $request_ano = $request->ano;

        $escola = Team::get();
        $turma = Turma::get();
        $ano = AbrirEEncerrarAnoLetivo::get();
        $disciplina = Materium::get();
        $alunos = Cadastro::where('escola_id', $request_escola)->where('turma_id', $request_turma)
        ->where('ano', $request_ano)->get();

        return view('admin.boletins.index', compact('request_escola', 'request_turma', 'request_ano', 'turma', 'escola', 'ano', 'disciplina', 'alunos'));
    }


    public function view(request $request)
    {
        abort_if(Gate::denies('boletin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->all());
        $request_aluno = $request->aluno;
        $request_escola = $request->escola;
        $request_turma = $request->turma;
        $request_ano = $request->ano;

        $alunos = Cadastro::where('id', $request_aluno)->get();
        $escola = Team::where('id', $request_escola)->get();
        $turma = Turma::where('id', $request_turma)->get();
        $ano = AbrirEEncerrarAnoLetivo::where('id', $request_ano)->get();
        $disciplina = Materium::get();

        $nota = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->get();

        $u1 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '1B')->get();

        $u2 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '2B')->get();

        $u3 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '3B')->get();

        $u4 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '4B')->get();

        $unidade1 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '1B')->get();

        $unidade2 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '2B')->get();

        $unidade3 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '3B')->get();

        $unidade4 = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', '4B')->get();

        $mrecf = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', 'MA')->get();

        $faltas = PresencaEletiva::where('alunos_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turmas_id', $request_turma)->where('ano', $request_ano)->where('selecione_falta', 'FNJ')->get();

        $total_aulas = PresencaEletiva::where('alunos_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turmas_id', $request_turma)->where('ano', $request_ano)->get();

        $presences = PresencaEletiva::where('alunos_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turmas_id', $request_turma)->where('ano', $request_ano)->where('selecione_falta', '!=' ,'FNJ')->get();

        $condition = Notum::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('bimestre', 'MA')->count();

        $resultadofinal = ResultadoFinal::where('aluno_id', $request_aluno)->where('escola_id', $request_escola)
        ->where('turma_id', $request_turma)->where('ano', $request_ano)->where('resultado_final',  'Não Aprovado')->count();

        return view('admin.boletins.view', compact('resultadofinal', 'total_aulas', 'condition', 'presences','faltas', 'nota', 'u1', 'u2', 'u3', 'u4', 'unidade1', 'unidade2', 'unidade3', 'unidade4', 'mrecf', 'request_aluno', 'request_escola', 'request_turma', 'request_ano', 'turma', 'escola', 'ano', 'disciplina', 'alunos'));
    }

    public function create()
    {
        abort_if(Gate::denies('boletin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.boletins.create');
    }

    public function store(StoreBoletinRequest $request)
    {
        $boletin = Boletin::create($request->all());

        return redirect()->route('admin.boletins.index');
    }

    public function edit(Boletin $boletin)
    {
        abort_if(Gate::denies('boletin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.boletins.edit', compact('boletin'));
    }

    public function update(UpdateBoletinRequest $request, Boletin $boletin)
    {
        $boletin->update($request->all());

        return redirect()->route('admin.boletins.index');
    }

    public function show(Boletin $boletin)
    {
        abort_if(Gate::denies('boletin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.boletins.show', compact('boletin'));
    }

    public function destroy(Boletin $boletin)
    {
        abort_if(Gate::denies('boletin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boletin->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoletinRequest $request)
    {
        Boletin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
