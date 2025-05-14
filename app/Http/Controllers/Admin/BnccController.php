<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Bncc;
use App\Models\Materium;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Arr;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BnccController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bncc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bnccs = Bncc::with([ 'disciplina', 'assinatura', 'team'])->get();

        $series = DB::table('bncc_serie')->get();

        $turmas = Turma::get();

        $materia = Materium::get();

        $users = User::get();

        $teams = Team::get();

        return view('admin.bnccs.index', compact('bnccs', 'series', 'materia', 'teams', 'turmas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bncc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bnccs.create', compact('disciplinas'));
    }

    public function store(Request $request)
    {

        $bncc = Bncc::create($request->all());
        for ($i = 0; $i < count($request->series); $i++) {

          DB::table('bncc_serie')->insert([
            'serie' =>  $request->series[$i],
            'bncc_id' => $bncc->id
          ]); }

        return redirect()->route('admin.bnccs.index');
    }

    public function edit(Bncc $bncc)
    {
        abort_if(Gate::denies('bncc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bncc->load('disciplina', 'assinatura', 'team');

        $db = DB::table('bncc_serie')->where('bncc_id', $bncc->id)->get('serie')->toArray();

        $collection = collect($db);

        $get = Arr::collapse([$collection]);

        $new = collect($get)->pluck('serie');

        $series = Arr::collapse([$new]);

        return view('admin.bnccs.edit', compact('bncc', 'disciplinas', 'series'));
    }

    public function update(Request $request, Bncc $bncc)
    {
        $bncc->update($request->all());
        for ($i = 0; $i < count($request->series); $i++) {
           DB::table('bncc_serie')
          ->where('bncc_id', $bncc->id)
          ->delete(); }

          for ($i = 0; $i < count($request->series); $i++) {

            DB::table('bncc_serie')->insert([
              'serie' =>  $request->series[$i],
              'bncc_id' => $bncc->id
            ]); }

        return redirect()->route('admin.bnccs.index');
    }

    public function show(Bncc $bncc)
    {
        abort_if(Gate::denies('bncc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bncc->load('disciplina', 'assinatura', 'team');

        $series = DB::table('bncc_serie')
       ->where('bncc_id', $bncc->id)->get();

        return view('admin.bnccs.show', compact('bncc', 'series'));
    }

    public function destroy(Bncc $bncc)
    {
        abort_if(Gate::denies('bncc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bncc->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Bncc::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
