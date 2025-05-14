<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAbrirEEncerrarAnoLetivoRequest;
use App\Http\Requests\StoreAbrirEEncerrarAnoLetivoRequest;
use App\Http\Requests\UpdateAbrirEEncerrarAnoLetivoRequest;
use App\Models\AbrirEEncerrarAnoLetivo;
use App\Models\Team;
use App\Models\User;
use App\Models\AnoLetivoSituacao;
use Carbon\Carbon;
use Gate;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbrirEEncerrarAnoLetivoController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $anos_letivos = AbrirEEncerrarAnoLetivo::with(['assinatura', 'team'])->get();

        $array = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->get();

        $anos_status = json_decode(json_encode($array), true);

        $array2 = DB::table('abrir_encerrar_ano_letivo')
        ->where('instituicao_id', auth()->user()->team_id)
        ->pluck('ano');

        $anos = Arr::collapse([$array2]);

        $teams = Team::get();

        $users = User::get();

        $auth = auth()->user()->roles->pluck('id');

        return view('admin.abrirEEncerrarAnoLetivos.index', compact('anos_letivos', 'anos', 'anos_status', 'teams', 'users'));
    }


    public function insert(Request $request)
    {
      // dd($request->all());

      DB::table('abrir_encerrar_ano_letivo')->insert([
        'ano' =>  $request->ano,
        'instituicao_id' => auth()->user()->team_id,
        'situacao' => 0,
        'assinatura_id' => auth()->user()->id,
        'team_id' => auth()->user()->team_id,
        'created_at' => Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon::now()->toDateTimeString()
      ]);

        return redirect()->route('admin.abrir-e-encerrar-ano-letivos.index');
    }

    public function up(Request $request)
    {
      // dd($request->all());

        DB::table('abrir_encerrar_ano_letivo')
        ->where('ano', $request->ano)
        ->where('instituicao_id', auth()->user()->team_id)
        ->update([
        'situacao' => $request->situacao,
        'updated_at' => Carbon::now()->toDateTimeString(),
    ]);

        return redirect()->route('admin.abrir-e-encerrar-ano-letivos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assinaturas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.abrirEEncerrarAnoLetivos.create', compact('auth', 'assinaturas', 'instituicaos'));
    }

    public function store(StoreAbrirEEncerrarAnoLetivoRequest $request) {

        $check = AbrirEEncerrarAnoLetivo::where('ano', $request->ano)->get()->count();

        if ($check === 0) {
        $abrirEEncerrarAnoLetivo = AbrirEEncerrarAnoLetivo::create($request->all());
        return redirect()->route('admin.abrir-e-encerrar-ano-letivos.index')
        ->with('message', 'Ano letivo adicionado com sucesso');
      } else {
      return redirect()->route('admin.abrir-e-encerrar-ano-letivos.create')
      ->with('message', 'Ano letivo ja adicionado anteriormente, evite duplicações'); }

    }

    public function edit(AbrirEEncerrarAnoLetivo $abrirEEncerrarAnoLetivo)
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assinaturas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $abrirEEncerrarAnoLetivo->load('instituicao', 'assinatura', 'team');

        return view('admin.abrirEEncerrarAnoLetivos.edit', compact('abrirEEncerrarAnoLetivo', 'assinaturas', 'instituicaos'));
    }

    public function update(UpdateAbrirEEncerrarAnoLetivoRequest $request, AbrirEEncerrarAnoLetivo $abrirEEncerrarAnoLetivo)
    {
        $abrirEEncerrarAnoLetivo->update($request->all());

        return redirect()->route('admin.abrir-e-encerrar-ano-letivos.index');
    }

    public function show(AbrirEEncerrarAnoLetivo $abrirEEncerrarAnoLetivo)
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $abrirEEncerrarAnoLetivo->load('instituicao', 'assinatura', 'team');

        return view('admin.abrirEEncerrarAnoLetivos.show', compact('abrirEEncerrarAnoLetivo'));
    }

    public function destroy(AbrirEEncerrarAnoLetivo $abrirEEncerrarAnoLetivo)
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $abrirEEncerrarAnoLetivo->delete();

        return back();
    }

    public function massDestroy(MassDestroyAbrirEEncerrarAnoLetivoRequest $request)
    {
        AbrirEEncerrarAnoLetivo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
