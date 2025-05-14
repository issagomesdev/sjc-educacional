<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPlanejamentoBimestralRequest;
use App\Http\Requests\StorePlanejamentoBimestralRequest;
use App\Http\Requests\UpdatePlanejamentoBimestralRequest;
use App\Models\Materium;
use App\Models\PlanejamentoBimestral;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PlanejamentoBimestralController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('planejamento_bimestral_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planejamentoBimestrals = PlanejamentoBimestral::with(['disciplina', 'escola', 'turma', 'assinatura', 'team'])->get();

        $materia = Materium::get();

        $teams = Team::get();

        $turmas = Turma::get();

        $users = User::get();

        $aulasd = PlanejamentoBimestral::where('aulas_dadas', 2)->get();

        $aulasp = PlanejamentoBimestral::where('aulas_dadas', 1)->get();

        return view('admin.planejamentoBimestrals.index', compact('planejamentoBimestrals', 'aulasd', 'aulasp', 'materia', 'teams', 'turmas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('planejamento_bimestral_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::pluck('serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.planejamentoBimestrals.create', compact('disciplinas', 'escolas', 'turmas'));
    }

    public function store(StorePlanejamentoBimestralRequest $request)
    {
        $planejamentoBimestral = PlanejamentoBimestral::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $planejamentoBimestral->id]);
        }

        return redirect()->route('admin.planejamento-bimestrals.index');
    }

    public function atualizar(Request $request, PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = $request->id;

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::pluck('serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planejamentoBimestral->load('disciplina', 'escola', 'turma', 'assinatura', 'team');

        return view('admin.planejamentoBimestrals.atualizar', compact('disciplinas', 'id', 'escolas', 'turmas', 'planejamentoBimestral'));
    }

    public function up(Request $request)
    {

      if($request->situacao == 1) {
        // dd($request->all());

        $id = $request->id;

        $planejamentoBimestral = PlanejamentoBimestral::where('id', $id)->first();
        $planejamentoBimestral->aulas_dadas = 1;
        $planejamentoBimestral->situacao = $request->situacao;
        $planejamentoBimestral->save();

        } else {

          $id = $request->id;

          $planejamentoBimestral = PlanejamentoBimestral::where('id', $id)->first();
          $planejamentoBimestral->situacao = $request->situacao;
          $planejamentoBimestral->aulas_dadas = 0;
          $planejamentoBimestral->save();


          }



        return redirect()->route('admin.planejamento-bimestrals.index');
    }

    public function edit(PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinas = Materium::pluck('nome_da_materia', 'id')->prepend(trans('global.pleaseSelect'), '');

        $escolas = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $turmas = Turma::pluck('ano_serie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planejamentoBimestral->load('disciplina', 'escola', 'turma', 'assinatura', 'team');

        return view('admin.planejamentoBimestrals.edit', compact('disciplinas', 'escolas', 'turmas', 'planejamentoBimestral'));
    }

    public function update(UpdatePlanejamentoBimestralRequest $request, PlanejamentoBimestral $planejamentoBimestral)
    {
        $planejamentoBimestral->update($request->all());

        return redirect()->route('admin.planejamento-bimestrals.index');
    }

    public function show(PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planejamentoBimestral->load('disciplina', 'escola', 'turma', 'assinatura', 'team');

        return view('admin.planejamentoBimestrals.show', compact('planejamentoBimestral'));
    }

    public function destroy(PlanejamentoBimestral $planejamentoBimestral)
    {
        abort_if(Gate::denies('planejamento_bimestral_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planejamentoBimestral->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanejamentoBimestralRequest $request)
    {
        PlanejamentoBimestral::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('planejamento_bimestral_create') && Gate::denies('planejamento_bimestral_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PlanejamentoBimestral();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
