<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\TipoDeProfissional;
use App\Models\Transferencium;
use App\Models\TransferenciasRecebidas;
use App\Models\Profissionai;
use App\Models\Instalar;
use App\Models\Deslocar;
use App\Models\Rematricula;
use App\Models\Materium;
use App\Models\Type;
use App\Models\TeamType;
use App\Models\Team;
use App\Models\User;
use App\Models\Turma;
use App\Models\Vaga;
use App\Models\Cadastro;
use App\Models\PresencaEletiva;
use App\Models\AbrirEEncerrarAnoLetivo;
use App\Models\ResultadoFinal;
use App\Models\Matricula;
use App\Models\Notum;
use Rainwater\Active\Active;
use DB;
use Gate;

class ReportsController extends Controller
{
  public function index()
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


      return view('admin.reports.index');
  }

  // user team

  public function teams(request $request)
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $request_type = $request->type;
      $request_localizacao = $request->localizacao;
      $request_estado = $request->estado;
      $request_situacao = $request->situacao;
      $request_administracao = $request->administracao;

      $users = User::get();
      $types = TeamType::get();
      $teams = Team::get();

      return view('admin.reports.teams', compact('request_type', 'request_localizacao',
      'request_estado', 'request_situacao', 'request_administracao', 'teams', 'users', 'types'));
  }

  // user

  public function usuarios()
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $users_active = Active::users()->get();
      $roles = Role::get();
      $types = Type::get();
      $users = User::get();

      return view('admin.reports.usuarios', compact('users', 'users_active', 'types', 'roles'));
  }

  // profissionais

  public function profissionais(request $request)
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      // dd($request->all());

      $request_genero = $request->genero;
      $request_localizacao = $request->localizacao;
      $request_estado = $request->estado;
      $request_situacao = $request->situacao;
      $request_funcao = $request->funcao;
      $request_instituicao = $request->instituicao;

      $profissionais = Profissionai::get();
      $types = TipoDeProfissional::get();
      $deslocar = Deslocar::get();
      $teams = Team::get();

      return view('admin.reports.profissionais', compact('request_genero', 'request_localizacao', 'request_estado',
      'request_situacao', 'request_funcao', 'request_instituicao','teams', 'profissionais', 'types', 'deslocar'));
  }

  // estudantes

  public function estudantes(request $request)
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      // dd($request->all());

      $request_escola = $request->escola;
      $request_serie = $request->serie;
      $request_genero = $request->genero;
      $request_situacao = $request->situacao;
      $request_localizacao = $request->localizacao;
      $request_estado = $request->estado;

      $cadastros = Cadastro::get();
      $enturmacao = Matricula::get();
      $teams = Team::get();
      $transferencia = Transferencium::get();
      $transferencias_recebidas = TransferenciasRecebidas::get();
      $rematriculas = Rematricula::get();

      return view('admin.reports.estudantes', compact('teams', 'request_escola', 'request_serie',
       'request_genero', 'request_situacao', 'request_localizacao', 'request_estado', 'rematriculas',
       'transferencias_recebidas', 'transferencia', 'cadastros', 'enturmacao'));
  }

  // turmas

  public function turmas(request $request)
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      // dd($request->all());

      $request_escola = $request->escola;
      $request_tipo = $request->tipo;
      $request_nivel = $request->nivel;
      $request_turno = $request->turno;
      $request_serie = $request->serie;

      $teams = Team::get();
      $turmas_total = Turma::get();
      $vagas = Vaga::get();
      $alunos = Cadastro::get();
      $estudantes = Cadastro::whereNotNull('turma_id')->orWhere('turma_id','<>','')->get();
      $c_estudantes = Cadastro::whereNotNull('turma_id')->get();
      $escolas = Team::where('tipo_de_instituicao_id', 1)->get();


      return view('admin.reports.turmas', compact('request_escola', 'request_tipo',
       'request_nivel', 'request_turno', 'request_serie', 'teams', 'c_estudantes',
       'request_escola', 'alunos', 'escolas', 'estudantes', 'turmas_total', 'vagas'));
  }

  // desempenho

  public function desempenho(request $request)
  {
      abort_if(Gate::denies('reports_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      // dd($request->all());

      $request_disciplina = $request->disciplina;
      $request_escola = $request->escola;
      $request_turno = $request->turno;
      $request_nivel = $request->nivel;
      $request_serie = $request->serie;
      $request_ano = $request->ano;

      $disciplinas = Materium::get();
      $anos = AbrirEEncerrarAnoLetivo::get();
      $escolas = Team::where('tipo_de_instituicao_id', 1)->get();


      return view('admin.reports.desempenho', compact('disciplinas', 'anos', 'escolas', 'request_disciplina', 'request_escola', 'request_turno',  'request_nivel', 'request_serie', 'request_ano'));
  }


}
