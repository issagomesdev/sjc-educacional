<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCadastroRequest;
use App\Http\Requests\StoreCadastroRequest;
use App\Http\Requests\UpdateCadastroRequest;
use App\Models\Cadastro;
use App\Models\Rotum;
use App\Models\Team;
use App\Models\Turma;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use DB;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

class CadastroController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cadastro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastros = Cadastro::with(['email_do_aluno', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura', 'media'])->get();

        $users = User::get();

        $rota = Rotum::get();

        $teams = Team::where('tipo_de_instituicao_id', 1)->get();

        $tid = Team::where('id', auth()->user()->team_id)->get();

        $turmas = Turma::get();

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

        return view('admin.cadastros.index', compact('auth', 'tid', 'cadastros', 'anos_letivos_abertos', 'anos_letivos', 'users', 'rota', 'teams', 'turmas'));
    }

    public function declaracao(Request $request)
    {
        abort_if(Gate::denies('cadastro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastro = Cadastro::where('id', $request->aluno)->with(['email_do_aluno', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura', 'media'])->first();
        // $ip = $request()->ip();
        $ip = '186.233.109.41';
        $data = Location::get($ip);

        return view('admin.cadastros.declaracao', compact('cadastro', 'data'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('cadastro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ano = $request->ano;

        $escola = $request->escola;

        $email_do_alunos = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $email_do_responsavel = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rota_percorridas = Rotum::get();

        return view('admin.cadastros.create', compact('ano', 'escola','email_do_responsavel', 'email_do_alunos', 'rota_percorridas'));
    }

    public function store(StoreCadastroRequest $request)
    {
      // dd($request->all());

        $cadastro = Cadastro::create($request->all());
        $cadastro['codigo_de_cadastro'] = $cadastro->id;
        $cadastro->save();

        if ($request->input('foto_do_aluno', false)) {
            $cadastro->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_do_aluno'))))->toMediaCollection('foto_do_aluno');
        }

        foreach ($request->input('arquivos_relacionados', []) as $file) {
            $cadastro->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cadastro->id]);
        }

        return redirect()->route('admin.cadastros.index');
    }

    public function edit(Cadastro $cadastro)
    {
        abort_if(Gate::denies('cadastro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $email_do_alunos = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $email_do_responsavel = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rota_percorridas = Rotum::get();

        $cadastro->load('email_do_aluno', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura');

        return view('admin.cadastros.edit', compact('email_do_alunos','email_do_responsavel', 'rota_percorridas', 'cadastro'));
    }

    public function update(UpdateCadastroRequest $request, Cadastro $cadastro)
    {
        $cadastro->update($request->all());

        if ($request->input('foto_do_aluno', false)) {
            if (!$cadastro->foto_do_aluno || $request->input('foto_do_aluno') !== $cadastro->foto_do_aluno->file_name) {
                if ($cadastro->foto_do_aluno) {
                    $cadastro->foto_do_aluno->delete();
                }
                $cadastro->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_do_aluno'))))->toMediaCollection('foto_do_aluno');
            }
        } elseif ($cadastro->foto_do_aluno) {
            $cadastro->foto_do_aluno->delete();
        }

        if (count($cadastro->arquivos_relacionados) > 0) {
            foreach ($cadastro->arquivos_relacionados as $media) {
                if (!in_array($media->file_name, $request->input('arquivos_relacionados', []))) {
                    $media->delete();
                }
            }
        }
        $media = $cadastro->arquivos_relacionados->pluck('file_name')->toArray();
        foreach ($request->input('arquivos_relacionados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $cadastro->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('arquivos_relacionados');
            }
        }

        return redirect()->route('admin.cadastros.index');
    }

    public function show(Cadastro $cadastro)
    {
        abort_if(Gate::denies('cadastro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastro->load('email_do_aluno', 'email_do_responsavel', 'rota_percorrida', 'escola', 'turma', 'team', 'assinatura', 'alunosPresencaEletivas', 'alunoMatriculas', 'alunosNota', 'alunosTurmas', 'alunosDispensas');

        return view('admin.cadastros.show', compact('cadastro'));
    }

    public function destroy(Cadastro $cadastro)
    {
        abort_if(Gate::denies('cadastro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cadastro->delete();

        return back();
    }

    public function massDestroy(MassDestroyCadastroRequest $request)
    {
        Cadastro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cadastro_create') && Gate::denies('cadastro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Cadastro();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
