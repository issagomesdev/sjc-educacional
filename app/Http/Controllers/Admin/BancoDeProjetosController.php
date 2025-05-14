<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBancoDeProjetoRequest;
use App\Http\Requests\StoreBancoDeProjetoRequest;
use App\Http\Requests\UpdateBancoDeProjetoRequest;
use App\Models\BancoDeProjeto;
use App\Models\Materium;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BancoDeProjetosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banco_de_projeto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjetos = BancoDeProjeto::with(['team', 'assinatura'])->where('situacao_do_projeto', 1)->orWhere('situacao_do_projeto', 2)->get();

        $teams = Team::get();

        $users = User::get();

        $materia = Materium::get();

        return view('admin.bancoDeProjetos.index', compact('bancoDeProjetos', 'materia', 'teams', 'users'));
    }

    public function propostas()
    {
        abort_if(Gate::denies('banco_de_projeto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjetos = BancoDeProjeto::with(['team', 'assinatura'])->where('situacao_do_projeto', 0)->orWhere('situacao_do_projeto', 3)
        ->orWhere('situacao_do_projeto', 4)->orWhere('situacao_do_projeto', 5)->orWhere('situacao_do_projeto', 6)
        ->orWhere('situacao_do_projeto', 7)->orWhere('situacao_do_projeto', 8)->get();

        $teams = Team::get();

        $materia = Materium::get();

        $users = User::get();

        return view('admin.bancoDeProjetos.propostas', compact('bancoDeProjetos', 'materia',  'teams', 'users'));
    }

    public function atualizar(Request $request, BancoDeProjeto $bancoDeProjetos)
    {
      // dd($request->all());

      abort_if(Gate::denies('change_bancos'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $id = $request->id;

      $area_de_conhecimentos = Materium::pluck('nome_da_materia', 'id');

      $bancoDeProjetos->load('area_de_conhecimentos', 'team', 'assinatura');

      return view('admin.bancoDeProjetos.atualizar', compact('id', 'area_de_conhecimentos', 'bancoDeProjetos'));
    }

    public function up(Request $request)
    {

        // dd($request->all());

        $id = $request->id;
        $situacao = $request->situacao_do_projeto;
        $sugestao = $request->sugestao;

        $bancoDeProjetos = BancoDeProjeto::where('id', $id)->first();
        $bancoDeProjetos->situacao_do_projeto = $situacao;
        $bancoDeProjetos->sugestao = $sugestao;
        $bancoDeProjetos->save();

        return redirect()->route('admin.projetos.propostas');
    }

    public function upb(Request $request )
    {

        // dd($request->all());

        $id = $request->id;
        $situacao = $request->situacao_do_projeto;

        $bancoDeProjetos = BancoDeProjeto::where('id', $id)->first();
        $bancoDeProjetos->situacao_do_projeto = $situacao;
        $bancoDeProjetos->save();

        return redirect()->route('admin.banco-de-projetos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('banco_de_projeto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bancoDeProjetos.create');
    }

    public function store(StoreBancoDeProjetoRequest $request)
    {
        $bancoDeProjeto = BancoDeProjeto::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bancoDeProjeto->id]);
        }

        return redirect()->route('admin.banco-de-projetos.index');
    }

    public function edit(BancoDeProjeto $bancoDeProjeto)
    {
        abort_if(Gate::denies('banco_de_projeto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjeto->load('team', 'assinatura');

        return view('admin.bancoDeProjetos.edit', compact('bancoDeProjeto'));
    }

    public function update(UpdateBancoDeProjetoRequest $request, BancoDeProjeto $bancoDeProjeto)
    {
        $bancoDeProjeto->update($request->all());

        return redirect()->route('admin.banco-de-projetos.index');
    }

    public function show(BancoDeProjeto $bancoDeProjeto)
    {
        abort_if(Gate::denies('banco_de_projeto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjeto->load('team', 'assinatura');

        return view('admin.bancoDeProjetos.show', compact('bancoDeProjeto'));
    }

    public function destroy(BancoDeProjeto $bancoDeProjeto)
    {
        abort_if(Gate::denies('banco_de_projeto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bancoDeProjeto->delete();

        return back();
    }

    public function massDestroy(MassDestroyBancoDeProjetoRequest $request)
    {
        BancoDeProjeto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('banco_de_projeto_create') && Gate::denies('banco_de_projeto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BancoDeProjeto();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
