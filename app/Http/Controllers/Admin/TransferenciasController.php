<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransferenciumRequest;
use App\Http\Requests\StoreTransferenciumRequest;
use App\Http\Requests\UpdateTransferenciumRequest;
use App\Models\Cadastro;
use App\Models\Team;
use Illuminate\Support\Carbon;
use App\Models\Transferencium;
use App\Models\TransferenciasRecebidas;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransferenciumImport;
use App\Exports\ExportTransferencium;
use App\Models\Turma;
use App\Models\Vaga;
use App\Models\User;
use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferenciasController extends Controller
{


  public function export(Request $request){

        $fileName = 'transferencia.csv';
        $transferencia = Transferencium::where('id', $request->id)->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ano_id', 'escola_id', 'new_escola_id', 'turma_id', 'old_turma_id', 'aluno_id', 'tipo_de_transferencia', 'assinatura_id', 'team_id', 'created_at', 'updated_at', 'deleted_at');

        $callback = function() use($transferencia, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transferencia as $transf) {
                $row['ano_id']  = $transf->ano_id;
                $row['escola_id']    = $transf->escola_id;
                $row['new_escola_id']    = $transf->new_escola_id;
                $row['turma_id']  = $transf->turma_id;
                $row['old_turma_id']  = $transf->old_turma_id;
                $row['aluno_id']  = $transf->aluno_id;
                $row['tipo_de_transferencia']  = $transf->tipo_de_transferencia;
                $row['assinatura_id']  = $transf->assinatura_id;
                $row['team_id']  = $transf->team_id;
                $row['created_at']  = $transf->created_at;
                $row['updated_at']  = $transf->updated_at;
                $row['deleted_at']  = $transf->deleted_at;

                fputcsv($file, array($row['ano_id'], $row['escola_id'], $row['new_escola_id'], $row['turma_id'], $row['old_turma_id'], $row['aluno_id'], $row['tipo_de_transferencia'], $row['assinatura_id'], $row['team_id'], $row['created_at'], $row['updated_at'], $row['deleted_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function index()
    {
        abort_if(Gate::denies('transferencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferencia = Transferencium::with(['escola', 'turma', 'aluno', 'team', 'assinatura'])->get();

        $cadastros = Cadastro::get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $tid = Team::where('id', auth()->user()->team_id)->get();

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $array_2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->where('situacao', 1)
        ->get();

        $anos_letivos_abertos = json_decode(json_encode($array_2), true);


        return view('admin.transferencia.index', compact('auth', 'tid', 'anos_letivos_abertos', 'anos_letivos', 'transferencia', 'teams', 'turmas', 'cadastros'));
    }

    public function recebidas()
    {
        abort_if(Gate::denies('transferencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferencia = TransferenciasRecebidas::with(['escola', 'old_turma', 'old_escola', 'aluno', 'team', 'assinatura'])->get();

        $cadastros = Cadastro::get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $tid = Team::where('id', auth()->user()->team_id)->get();

        $turmas = Turma::get();

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_letivos = json_decode(json_encode($array), true);

        $array_2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->where('situacao', 1)
        ->get();

        $anos_letivos_abertos = json_decode(json_encode($array_2), true);

        return view('admin.transferencia.recebidas', compact('auth', 'tid', 'anos_letivos_abertos', 'anos_letivos', 'transferencia', 'teams', 'turmas', 'cadastros'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('transferencium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_de_transferencia = $request->tipo_de_transferencia;

        $escola = $request->escola;

        $ano = $request->ano;

        $alunos = Cadastro::where('escola_id', $escola)->where('situacao', 1)->get();

        $alunos2 = Cadastro::where('escola_id', $escola)->where('situacao', '!=', 2)->get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $turmas = Turma::where('escola_id', $escola)->get();

        $vagas = Vaga::get();

        return view('admin.transferencia.create', compact('tipo_de_transferencia', 'teams', 'vagas', 'alunos', 'alunos2', 'escola', 'ano', 'turmas'));
    }

    public function upTurma(Request $request)
    {
        // dd($request->all());

        $turma = $request->turma_id;
        $aluno = $request->aluno_id;

        $cadastro = Cadastro::where('id', $aluno)->first();
        $old_turma = $cadastro->turma_id;
        $transferencium = Transferencium::create($request->all());
        $transferencium->old_turma_id = $old_turma;
        $transferencium->save();
        $cadastro->turma_id = $turma;
        $cadastro->save();


        return redirect()->route('admin.transferencia.index');
    }

    public function upInterna(Request $request, Transferencium $transferencium, TransferenciasRecebidas $transf)
    {
          // dd($request->all());


      // ajusta os dados e muda a situação do aluno na escola antiga para transferido
          $cadastro = Cadastro::where('id', $request->aluno_id)->first();
          // dd($cadastro->foto_do_aluno);
          $cadastro->situacao = 2;
          $cadastro->save();

      // replica a ficha do aluno na nova escola e
          $cad = Cadastro::where('id', $request->aluno_id)->first();
          $newCad = $cad->replicate();
          $newCad->escola_id = $request->escola_id;
          $newCad->turma_id = 0;
          $newCad->situacao = 1;
          $newCad->assinatura_id = $request->assinatura_id;
          $newCad->team_id = $request->team_id;
          $newCad->created_at = Carbon::now();
          $newCad->updated_at = Carbon::now();
          $newCad->save();

      //cria um registro de transferencia env
      $cad2 = Cadastro::where('id', $request->aluno_id)->first();
      $transferencium->ano_id = $request->ano_id;
      $transferencium->tipo_de_transferencia = $request->tipo_de_transferencia;
      $transferencium->escola_id = $cad2->escola_id;
      $transferencium->turma_id = $cad2->turma_id;
      $transferencium->aluno_id = $cad2->id;
      $transferencium->new_escola_id = $newCad->escola_id;
      $transferencium->assinatura_id = $request->assinatura_id;
      $transferencium->team_id = $request->team_id;
      $transferencium->created_at = Carbon::now();
      $transferencium->updated_at = Carbon::now();
      $transferencium->save();

      //cria um registro de transferencia receive
      $cad3 = Cadastro::where('id', $request->aluno_id)->first();
      $transf->ano_id = $request->ano_id;
      $transf->tipo_de_transferencia = $request->tipo_de_transferencia;
      $transf->escola_id = $newCad->escola_id;
      $transf->old_escola_id = $cad3->escola_id;
      $transf->old_turma_id = $cad3->turma_id;
      $transf->aluno_id = $newCad->id;
      $transf->assinatura_id = $request->assinatura_id;
      $transf->team_id = $request->team_id;
      $transf->created_at = Carbon::now();
      $transf->updated_at = Carbon::now();
      $transf->save();


        return redirect()->route('admin.transferencia.index');
    }

    public function upExterna(Request $request, Transferencium $transferencium)
    {

      $cad = Cadastro::where('id', $request->aluno_id)->first();
      $transferencium->ano_id = $request->ano_id;
      $transferencium->tipo_de_transferencia = $request->tipo_de_transferencia;
      $transferencium->escola_id = $cad->escola_id;
      $transferencium->turma_id = $cad->turma_id;
      $transferencium->aluno_id = $cad->id;
      $transferencium->assinatura_id = $request->assinatura_id;
      $transferencium->team_id = $request->team_id;
      $transferencium->created_at = Carbon::now();
      $transferencium->updated_at = Carbon::now();
      $transferencium->save();

      $cadastro = Cadastro::where('id', $request->aluno_id)->first();
      $cadastro->situacao = 2;
      $cadastro->save();


        return redirect()->route('admin.transferencia.index');
    }

    public function show(Request $request, Transferencium $transferencium)
    {
        abort_if(Gate::denies('transferencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferencium->load('aluno', 'escola', 'turma', 'old_turma', 'team', 'assinatura');

        return view('admin.transferencia.show', compact('transferencium'));
    }

    public function destroy(Transferencium $transferencium)
    {
        abort_if(Gate::denies('transferencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferencium->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransferenciumRequest $request)
    {
        Transferencium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
