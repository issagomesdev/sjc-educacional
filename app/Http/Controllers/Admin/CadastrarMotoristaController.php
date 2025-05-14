<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCadastrarMotoristumRequest;
use App\Http\Requests\StoreCadastrarMotoristumRequest;
use App\Http\Requests\UpdateCadastrarMotoristumRequest;
use App\Models\CadastrarMotoristum;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CadastrarMotoristaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cadastrar_motoristum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarMotorista = CadastrarMotoristum::with(['instituicao', 'team', 'assinatura'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.cadastrarMotorista.index', compact('cadastrarMotorista', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('cadastrar_motoristum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cadastrarMotorista.create', compact('instituicaos'));
    }

    public function store(StoreCadastrarMotoristumRequest $request)
    {
        $cadastrarMotoristum = CadastrarMotoristum::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cadastrarMotoristum->id]);
        }

        return redirect()->route('admin.cadastrar-motorista.index');
    }

    public function edit(CadastrarMotoristum $cadastrarMotoristum)
    {
        abort_if(Gate::denies('cadastrar_motoristum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cadastrarMotoristum->load('instituicao', 'team', 'assinatura');

        return view('admin.cadastrarMotorista.edit', compact('instituicaos', 'cadastrarMotoristum'));
    }

    public function update(UpdateCadastrarMotoristumRequest $request, CadastrarMotoristum $cadastrarMotoristum)
    {
        $cadastrarMotoristum->update($request->all());

        return redirect()->route('admin.cadastrar-motorista.index');
    }

    public function show(CadastrarMotoristum $cadastrarMotoristum)
    {
        abort_if(Gate::denies('cadastrar_motoristum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarMotoristum->load('instituicao', 'team', 'assinatura', 'motoristaResponsavelCadastrarveiculos');

        return view('admin.cadastrarMotorista.show', compact('cadastrarMotoristum'));
    }

    public function destroy(CadastrarMotoristum $cadastrarMotoristum)
    {
        abort_if(Gate::denies('cadastrar_motoristum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastrarMotoristum->delete();

        return back();
    }

    public function massDestroy(MassDestroyCadastrarMotoristumRequest $request)
    {
        CadastrarMotoristum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cadastrar_motoristum_create') && Gate::denies('cadastrar_motoristum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CadastrarMotoristum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
