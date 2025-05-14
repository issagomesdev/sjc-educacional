<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProfissionaiRequest;
use App\Http\Requests\StoreProfissionaiRequest;
use App\Http\Requests\UpdateProfissionaiRequest;
use App\Models\Profissionai;
use App\Models\TipoDeProfissional;
use App\Models\Team;
use App\Models\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\AbrirEEncerrarAnoLetivo;
use Symfony\Component\HttpFoundation\Response;

class ProfissionaisController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('profissional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profissionais = Profissionai::with(['e_mail_de_usuario', 'instituicao', 'team', 'assinatura', 'media'])->get();

        $users = User::get();

        $teams = Team::get();

        $tipo_de_profissionals = TipoDeProfissional::get();

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

        return view('admin.profissionais.index', compact('auth','anos_letivos_abertos', 'anos_letivos', 'profissionais', 'tipo_de_profissionals', 'teams', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('profissional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $e_mail_de_usuarios = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.profissionais.create', compact('e_mail_de_usuarios'));
    }

    public function store(StoreProfissionaiRequest $request)
    {
        $profissionai = Profissionai::create($request->all());

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $profissionai->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $profissionai->id]);
        }

        return redirect()->route('admin.profissionais.index');
    }

    public function edit(Profissionai $profissionai)
    {
        abort_if(Gate::denies('profissional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $e_mail_de_usuarios = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profissionai->load('e_mail_de_usuario', 'instituicao', 'team', 'assinatura');

        return view('admin.profissionais.edit', compact('e_mail_de_usuarios', 'profissionai'));
    }

    public function update(UpdateProfissionaiRequest $request, Profissionai $profissionai)
    {
        $profissionai->update($request->all());

        if (count($profissionai->arquivos_relacionados) > 0) {
            foreach ($profissionai->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $profissionai->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $profissionai->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return redirect()->route('admin.profissionais.index');
    }

    public function show(Profissionai $profissionai)
    {
        abort_if(Gate::denies('profissional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profissionai->load('e_mail_de_usuario', 'instituicao', 'team', 'assinatura', 'professorQuadroDeHorarios');

        return view('admin.profissionais.show', compact('profissionai'));
    }

    public function destroy(Profissionai $profissionai)
    {
        abort_if(Gate::denies('profissional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profissionai->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfissionaiRequest $request)
    {
        Profissionai::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('profissional_create') && Gate::denies('profissionai_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Profissionai();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
