<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySemaulaRequest;
use App\Http\Requests\StoreSemaulaRequest;
use App\Http\Requests\UpdateSemaulaRequest;
use Illuminate\Support\Arr;
use App\Models\Semaula;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SemaulasController extends Controller
{
    use MediaUploadingTrait;

    public function index(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semaulas = Semaula::with(['instituicao', 'team', 'assinatura'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.semaulas.index', compact('semaulas', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('semaula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $instituicao = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.semaulas.create', compact('auth', 'instituicao'));
    }

    public function store(StoreSemaulaRequest $request)
    {
      // dd($request->all());

        $semaula = Semaula::create($request->all());
        $semaula->escolas()->sync($request->input('escolas', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $semaula->id]);
        }

        return redirect()->route('admin.semaulas.index');
    }

    public function edit(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auth = auth()->user()->tipo_de_acessos->pluck('id');

        $instituicao = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $semaula->load('instituicao', 'team', 'assinatura');

        return view('admin.semaulas.edit', compact('instituicao', 'auth', 'semaula'));
    }

    public function update(UpdateSemaulaRequest $request, Semaula $semaula)
    {
        $semaula->update($request->all());
        $semaula->escolas()->sync($request->input('escolas', []));

        return redirect()->route('admin.semaulas.index');
    }

    public function show(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semaula->load('instituicao', 'team', 'assinatura');



        return view('admin.semaulas.show', compact('semaula'));
    }

    public function destroy(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semaula->delete();

        return back();
    }

    public function massDestroy(MassDestroySemaulaRequest $request)
    {
        Semaula::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('semaula_create') && Gate::denies('semaula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Semaula();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
