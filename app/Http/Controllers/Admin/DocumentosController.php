<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Models\Documento;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DocumentosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentos = Documento::with(['instituicao', 'team', 'assinatura', 'media'])->get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.documentos.index', compact('documentos', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('documento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

                return view('admin.documentos.create', compact('instituicaos'));
    }

    public function store(StoreDocumentoRequest $request)
    {
      if($request->has('instituicao_id') && !empty($request->input('instituicao_id'))) {

        $data = $request->all();
        $documento= Documento::create($data);

    } else {

      $data = $request->all();
      $data['instituicao_id'] = auth()->user()->id;
      $documento= Documento::create($data);

    }

        foreach ($request->input('anexos', []) as $file) {
            $documento->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $documento->id]);
        }

        return redirect()->route('admin.documentos.index');
    }

    public function edit(Documento $documento)
    {
        abort_if(Gate::denies('documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicaos = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documento->load('instituicao', 'team', 'assinatura');

        return view('admin.documentos.edit', compact('documento', 'instituicaos'));
    }

    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {
        $documento->update($request->all());

        if (count($documento->anexos) > 0) {
            foreach ($documento->anexos as $media) {
                if (!in_array($media->file_name, $request->input('anexos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $documento->anexos->pluck('file_name')->toArray();
        foreach ($request->input('anexos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $documento->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexos');
            }
        }

        return redirect()->route('admin.documentos.index');
    }

    public function show(Documento $documento)
    {
        abort_if(Gate::denies('documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documento->load('instituicao', 'team', 'assinatura');

        return view('admin.documentos.show', compact('documento'));
    }

    public function destroy(Documento $documento)
    {
        abort_if(Gate::denies('documento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documento->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentoRequest $request)
    {
        Documento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('documento_create') && Gate::denies('documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Documento();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
