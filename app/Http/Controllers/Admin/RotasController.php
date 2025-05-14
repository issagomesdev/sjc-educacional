<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRotumRequest;
use App\Http\Requests\StoreRotumRequest;
use App\Http\Requests\UpdateRotumRequest;
use App\Models\CadastrarMotoristum;
use App\Models\Cadastrarveiculo;
use App\Models\Cadastro;
use App\Models\Rotum;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RotasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('rotum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rota = Rotum::with(['veiculo_responsavel', 'motorista_responsavel', 'team', 'assinatura'])->get();

        $cadastrarveiculos = Cadastrarveiculo::get();

        $cadastrar_motorista = CadastrarMotoristum::get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.rota.index', compact('rota', 'cadastrarveiculos', 'cadastrar_motorista', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('rotum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veiculo = Cadastrarveiculo::get();

        $motorista_responsavels = CadastrarMotoristum::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rota.create', compact('veiculo', 'motorista_responsavels'));
    }

    public function store(StoreRotumRequest $request)
    {
        $rotum = Rotum::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rotum->id]);
        }

        return redirect()->route('admin.rota.index');
    }

    public function edit(Rotum $rotum)
    {
        abort_if(Gate::denies('rotum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veiculo = Cadastrarveiculo::get();

        $motorista_responsavels = CadastrarMotoristum::pluck('nome_completo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rotum->load('veiculo_responsavel', 'motorista_responsavel', 'team', 'assinatura');

        return view('admin.rota.edit', compact('veiculo', 'motorista_responsavels', 'rotum'));
    }

    public function update(UpdateRotumRequest $request, Rotum $rotum)
    {
        $rotum->update($request->all());

        return redirect()->route('admin.rota.index');
    }

    public function show(Rotum $rotum)
    {
        abort_if(Gate::denies('rotum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rotum->load('veiculo_responsavel', 'motorista_responsavel', 'team', 'assinatura', 'rotaPercorridaCadastros');

        $alunos = Cadastro::where('rota_percorrida_id', $rotum->id)->get();

        return view('admin.rota.show', compact('alunos', 'rotum'));
    }

    public function destroy(Rotum $rotum)
    {
        abort_if(Gate::denies('rotum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rotum->delete();

        return back();
    }

    public function massDestroy(MassDestroyRotumRequest $request)
    {
        Rotum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('rotum_create') && Gate::denies('rotum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Rotum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
