<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserAlertRequest;
use App\Http\Requests\StoreUserAlertRequest;
use App\Http\Requests\UpdateUserAlertRequest;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\UserAlert;
use Gate;
use DB;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UserAlertsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlerts = UserAlert::with(['instituicoes', 'hierarquias', 'users', 'assinatura', 'team', 'media'])->get();

        $teams = Team::get();

        $roles = Role::get();

        $users = User::get();

        return view('admin.userAlerts.index', compact('roles', 'teams', 'userAlerts', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_alert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicoes = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hierarquias = Role::get();

        $users = User::pluck('name', 'id');

        return view('admin.userAlerts.create', compact('hierarquias', 'instituicoes', 'users'));
    }

    public function store(Request $request)
    {

$array = DB::table('role_user')->whereIn('role_id', $request->input('hierarquias', []))->get();
$get = Arr::collapse([$array]);
$new = collect($get)->pluck('user_id')->toArray();
$users = array_unique($new, SORT_REGULAR);

        $userAlert = UserAlert::create($request->all());
        $userAlert->users()->sync($users, []);
        if ($request->input('anexos', false)) {
            $userAlert->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexos'))))->toMediaCollection('anexos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userAlert->id]);
        }

        return redirect()->route('admin.user-alerts.index');
    }

    public function edit(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituicoes = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hierarquias = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id');

        $userAlert->load('instituicoes', 'hierarquias', 'users', 'assinatura', 'team');

        return view('admin.userAlerts.edit', compact('hierarquias', 'instituicoes', 'userAlert', 'users'));
    }

    public function update(UpdateUserAlertRequest $request, UserAlert $userAlert)
    {
        $userAlert->update($request->all());
        $userAlert->users()->sync($request->input('users', []));
        if ($request->input('anexos', false)) {
            if (!$userAlert->anexos || $request->input('anexos') !== $userAlert->anexos->file_name) {
                if ($userAlert->anexos) {
                    $userAlert->anexos->delete();
                }
                $userAlert->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexos'))))->toMediaCollection('anexos');
            }
        } elseif ($userAlert->anexos) {
            $userAlert->anexos->delete();
        }

        return redirect()->route('admin.user-alerts.index');
    }

    public function show(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlert->load('instituicoes', 'hierarquias', 'users', 'assinatura', 'team');

        return view('admin.userAlerts.show', compact('userAlert'));
    }

    public function destroy(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlert->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAlertRequest $request)
    {
        UserAlert::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_alert_create') && Gate::denies('user_alert_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserAlert();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function read(Request $request)
    {
        $alerts = \Auth::user()->userUserAlerts()->where('read', false)->get();
        foreach ($alerts as $alert) {
            $pivot       = $alert->pivot;
            $pivot->read = true;
            $pivot->save();
        }
    }
}
