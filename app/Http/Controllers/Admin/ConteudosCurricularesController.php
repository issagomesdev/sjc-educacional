<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConteudosCurriculareRequest;
use App\Http\Requests\StoreConteudosCurriculareRequest;
use App\Http\Requests\UpdateConteudosCurriculareRequest;
use App\Models\ConteudosCurriculare;
use App\Models\Bncc;
use App\Models\CurriculoDePernambuco;
use App\Models\Materium;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Arr;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ConteudosCurricularesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('conteudos_curriculare_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conteudosCurriculares = ConteudosCurriculare::with(['disciplina', 'turmas', 'team', 'assinatura'])->get();

        $cont = $conteudosCurriculares->pluck('id');

        $series = DB::table('conteudos_curriculare_turma')->get();

        $teams = Team::get();

        $materia = Materium::get();

        $turmas = Turma::get();

        $users = User::get();

        return view('admin.conteudosCurriculares.index', compact('series', 'conteudosCurriculares', 'materia', 'teams', 'turmas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('conteudos_curriculare_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bnccs = Bncc::get();

        $cdps = CurriculoDePernambuco::get();

        return view('admin.conteudosCurriculares.create', compact('bnccs', 'cdps', 'disciplinas'));
    }

    public function store(StoreConteudosCurriculareRequest $request)
    {

    $conteudosCurriculare = ConteudosCurriculare::create($request->all());

        for ($i = 0; $i < count($request->serie); $i++) {

          DB::table('conteudos_curriculare_turma')->insert([
            'serie' =>  $request->serie[$i],
            'conteudos_curriculare_id' => $conteudosCurriculare->id
          ]);

          if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $conteudosCurriculare->id]);
        }

        }

        return redirect()->route('admin.conteudos-curriculares.index');
    }

    public function edit(ConteudosCurriculare $conteudosCurriculare)
    {
        abort_if(Gate::denies('conteudos_curriculare_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $db = DB::table('conteudos_curriculare_turma')->where('conteudos_curriculare_id', $conteudosCurriculare->id)->get('serie')->toArray();

        $collection = collect($db);

        $get = Arr::collapse([$collection]);

        $new = collect($get)->pluck('serie');

        $series = Arr::collapse([$new]);

        $bnccs = Bncc::get();

        $cdps = CurriculoDePernambuco::get();

        // dd($series = in_array("Creche I", $uni));

        $conteudosCurriculare->load('disciplina', 'team', 'assinatura');

        return view('admin.conteudosCurriculares.edit', compact('bnccs', 'cdps', 'series', 'conteudosCurriculare', 'disciplinas', 'escolas'));
    }

    public function update(UpdateConteudosCurriculareRequest $request, ConteudosCurriculare $conteudosCurriculare)
    {
        $conteudosCurriculare->update($request->all());
        for ($i = 0; $i < count($request->serie); $i++) {
           DB::table('conteudos_curriculare_turma')
          ->where('conteudos_curriculare_id', $conteudosCurriculare->id)
          ->delete(); }

          for ($i = 0; $i < count($request->serie); $i++) {

            DB::table('conteudos_curriculare_turma')->insert([
              'serie' =>  $request->serie[$i],
              'conteudos_curriculare_id' => $conteudosCurriculare->id
            ]); }


        return redirect()->route('admin.conteudos-curriculares.index');
    }

    public function show(ConteudosCurriculare $conteudosCurriculare)
    {
        abort_if(Gate::denies('conteudos_curriculare_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conteudosCurriculare->load('disciplina', 'team', 'assinatura');

        $series = DB::table('conteudos_curriculare_turma')
       ->where('conteudos_curriculare_id', $conteudosCurriculare->id)->get();

        return view('admin.conteudosCurriculares.show', compact('conteudosCurriculare', 'series'));
    }

    public function destroy(ConteudosCurriculare $conteudosCurriculare)
    {
        abort_if(Gate::denies('conteudos_curriculare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conteudosCurriculare->delete();

        return back();
    }

    public function massDestroy(MassDestroyConteudosCurriculareRequest $request)
    {
        ConteudosCurriculare::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('conteudos_curriculare_create') && Gate::denies('conteudos_curriculare_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ConteudosCurriculare();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
