<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\CurriculoDePernambuco;
use App\Models\Materium;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Arr;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurriculoDePernambucoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('curriculo_de_pernambuco_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $curriculoDePernambucos = CurriculoDePernambuco::with([ 'disciplina', 'assinatura', 'team'])->get();

        $series = DB::table('curriculo_de_pernambuco_serie')->get();

        $turmas = Turma::get();

        $materia = Materium::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.curriculoDePernambucos.index', compact('curriculoDePernambucos','series', 'materia', 'teams', 'turmas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('curriculo_de_pernambuco_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.curriculoDePernambucos.create', compact('disciplinas'));
    }

    public function store(Request $request)
    {
        $curriculoDePernambuco = CurriculoDePernambuco::create($request->all());
        for ($i = 0; $i < count($request->series); $i++) {

          DB::table('curriculo_de_pernambuco_serie')->insert([
            'serie' =>  $request->series[$i],
            'curriculo_de_pernambuco_id' => $curriculoDePernambuco->id
          ]); }

        return redirect()->route('admin.curriculo-de-pernambucos.index');
    }

    public function edit(CurriculoDePernambuco $curriculoDePernambuco)
    {
        abort_if(Gate::denies('curriculo_de_pernambuco_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $curriculoDePernambuco->load('disciplina', 'assinatura', 'team');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $db = DB::table('curriculo_de_pernambuco_serie')->where('curriculo_de_pernambuco_id', $curriculoDePernambuco->id)->get('serie')->toArray();

        $collection = collect($db);

        $get = Arr::collapse([$collection]);

        $new = collect($get)->pluck('serie');

        $series = Arr::collapse([$new]);

        return view('admin.curriculoDePernambucos.edit', compact('curriculoDePernambuco', 'disciplinas', 'series'));
    }

    public function update(Request $request, CurriculoDePernambuco $curriculoDePernambuco)
    {
        $curriculoDePernambuco->update($request->all());
        for ($i = 0; $i < count($request->series); $i++) {
           DB::table('curriculo_de_pernambuco_serie')
          ->where('curriculo_de_pernambuco_id', $curriculoDePernambuco->id)
          ->delete(); }

          for ($i = 0; $i < count($request->series); $i++) {

            DB::table('curriculo_de_pernambuco_serie')->insert([
              'serie' =>  $request->series[$i],
              'curriculo_de_pernambuco_id' => $curriculoDePernambuco->id
            ]); }

        return redirect()->route('admin.curriculo-de-pernambucos.index');
    }

    public function show(CurriculoDePernambuco $curriculoDePernambuco)
    {
        abort_if(Gate::denies('curriculo_de_pernambuco_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $curriculoDePernambuco->load('disciplina', 'assinatura', 'team');

        $series = DB::table('curriculo_de_pernambuco_serie')
       ->where('curriculo_de_pernambuco_id', $curriculoDePernambuco->id)->get();

        return view('admin.curriculoDePernambucos.show', compact('series', 'curriculoDePernambuco'));
    }

    public function destroy(CurriculoDePernambuco $curriculoDePernambuco)
    {
        abort_if(Gate::denies('curriculo_de_pernambuco_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $curriculoDePernambuco->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurriculoDePernambucoRequest $request)
    {
        CurriculoDePernambuco::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
