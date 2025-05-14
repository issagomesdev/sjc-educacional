<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Profissionai;
use App\Models\Team;
use App\Models\Type;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

  use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::get();

        $roles = Role::get();

        $types = Type::get();

        $teams = Team::get();

        $auth = auth()->user()->team_id;

        $autht = auth()->user()->tipo_de_acessos->pluck('id');

        $yout = Team::where('id', $auth)->get();

        

        return view('admin.users.index', compact('yout','autht', 'users', 'roles', 'types', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $tipo_de_acessos = Type::pluck('titulo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = auth()->user()->team_id;

        $autht = auth()->user()->tipo_de_acessos->pluck('id');

        $yout = Team::where('id', $auth)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assinatura_teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('roles', 'autht', 'yout', 'tipo_de_acessos', 'teams', 'assinatura_teams'));
    }

    public function store(StoreUserRequest $request)
    {


        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->tipo_de_acessos()->sync($request->input('tipo_de_acessos', []));
        if ($request->input('foto_de_perfil', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_de_perfil'))))->toMediaCollection('foto_de_perfil');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $tipo_de_acessos = Type::pluck('titulo', 'id');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = auth()->user()->team_id;

        $autht = auth()->user()->tipo_de_acessos->pluck('id');

        $yout = Team::where('id', $auth)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assinatura_teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'tipo_de_acessos', 'team', 'assinatura', 'assinatura_team');



        return view('admin.users.edit', compact('roles', 'yout', 'autht', 'tipo_de_acessos', 'teams', 'assinatura_teams', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->tipo_de_acessos()->sync($request->input('tipo_de_acessos', []));
        if ($request->input('foto_de_perfil', false)) {
           if (!$user->foto_de_perfil || $request->input('foto_de_perfil') !== $user->foto_de_perfil->file_name) {
               if ($user->foto_de_perfil) {
                   $user->foto_de_perfil->delete();
               }
               $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto_de_perfil'))))->toMediaCollection('foto_de_perfil');
           }
       } elseif ($user->foto_de_perfil) {
           $user->foto_de_perfil->delete();
       }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'tipo_de_acessos', 'team', 'assinatura', 'assinatura_team', 'assinaturaPermissions', 'emailDoAlunoCadastros', 'assinaturaCadastrarBibliotecas', 'assinaturaDocumentos', 'eMailDeUsuarioProfissionais', 'userUserAlerts');

        $ficha = Profissionai::where('e_mail_de_usuario_id', $user->id)->get();

        return view('admin.users.show', compact('user', 'ficha'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
