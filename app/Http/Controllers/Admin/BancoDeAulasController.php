<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBancoDeAulaRequest;
use App\Http\Requests\StoreBancoDeAulaRequest;
use App\Http\Requests\UpdateBancoDeAulaRequest;
use App\Models\BancoDeAula;
use App\Models\Materium;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BancoDeAulasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banco_de_aula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeAulas = BancoDeAula::with(['area_de_conhecimentos', 'team', 'assinatura'])->where('situacao_do_projeto', 1)->orWhere('situacao_do_projeto', 2)->get();

        $materia = Materium::get();

        $teams = Team::get();

        $users = User::get();

        return view('admin.bancoDeAulas.index', compact('bancoDeAulas', 'materia', 'teams', 'users'));
    }

    public function propostas()
    {

        abort_if(Gate::denies('banco_de_aula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeAulas = BancoDeAula::with(['team', 'assinatura'])->where('situacao_do_projeto', 0)->orWhere('situacao_do_projeto', 3)
        ->orWhere('situacao_do_projeto', 4)->orWhere('situacao_do_projeto', 5)->orWhere('situacao_do_projeto', 6)
        ->orWhere('situacao_do_projeto', 7)->orWhere('situacao_do_projeto', 8)->get();

        $teams = Team::get();

        $materia = Materium::get();

        $users = User::get();

        return view('admin.bancoDeAulas.propostas', compact('bancoDeAulas','materia', 'teams', 'users'));
    }

    public function atualizar(Request $request, BancoDeAula $bancoDeAula)
    {
      // dd($request->all());

      abort_if(Gate::denies('change_bancos'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $id = $request->id;

      $area_de_conhecimentos = Materium::pluck('nome_da_materia', 'id');

      $bancoDeAula->load('area_de_conhecimentos', 'team', 'assinatura');

      return view('admin.bancoDeAulas.atualizar', compact('id', 'area_de_conhecimentos', 'bancoDeAula'));
    }

    public function up(Request $request)
    {

        // dd($request->all());

        $id = $request->id;
        $situacao = $request->situacao_do_projeto;
        $sugestao = $request->sugestao;

        $bancoDeAula = BancoDeAula::where('id', $id)->first();
        $bancoDeAula->situacao_do_projeto = $situacao;
        $bancoDeAula->sugestao = $sugestao;
        $bancoDeAula->save();

        return redirect()->route('admin.aulas.propostas');
    }

    public function upb(Request $request )
    {

        // dd($request->all());

        $id = $request->id;
        $situacao = $request->situacao_do_projeto;

        $bancoDeAula = BancoDeAula::where('id', $id)->first();
        $bancoDeAula->situacao_do_projeto = $situacao;
        $bancoDeAula->save();

        return redirect()->route('admin.banco-de-aulas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('banco_de_aula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area_de_conhecimentos = Materium::pluck('nome_da_materia', 'id');

        return view('admin.bancoDeAulas.create', compact('area_de_conhecimentos'));
    }

    public function store(StoreBancoDeAulaRequest $request)
    {

        $bancoDeAula = BancoDeAula::create($request->all());
        $bancoDeAula->area_de_conhecimentos()->sync($request->input('area_de_conhecimentos', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bancoDeAula->id]);
        }

        return redirect()->route('admin.aulas.propostas');
    }

    public function edit(BancoDeAula $bancoDeAula)
    {
        abort_if(Gate::denies('banco_de_aula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area_de_conhecimentos = Materium::pluck('nome_da_materia', 'id');

        $bancoDeAula->load('area_de_conhecimentos', 'team', 'assinatura');

        return view('admin.bancoDeAulas.edit', compact('area_de_conhecimentos', 'bancoDeAula'));
    }

    public function update(UpdateBancoDeAulaRequest $request, BancoDeAula $bancoDeAula)
    {

        $bancoDeAula->update($request->all());

        $bancoDeAula->area_de_conhecimentos()->sync($request->input('area_de_conhecimentos', []));

        return redirect()->route('admin.aulas.propostas');
    }

    public function show(BancoDeAula $bancoDeAula)
    {
        abort_if(Gate::denies('banco_de_aula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeAula->load('area_de_conhecimentos', 'team', 'assinatura');

        return view('admin.bancoDeAulas.show', compact('bancoDeAula'));
    }

    public function destroy(BancoDeAula $bancoDeAula)
    {
        abort_if(Gate::denies('banco_de_aula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeAula->delete();

        return back();
    }

    public function massDestroy(MassDestroyBancoDeAulaRequest $request)
    {
        BancoDeAula::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('banco_de_aula_create') && Gate::denies('banco_de_aula_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BancoDeAula();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
