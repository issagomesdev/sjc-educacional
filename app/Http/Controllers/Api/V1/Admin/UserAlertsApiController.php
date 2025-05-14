<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserAlertRequest;
use App\Http\Requests\UpdateUserAlertRequest;
use App\Http\Resources\Admin\UserAlertResource;
use App\Models\UserAlert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAlertsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserAlertResource(UserAlert::with(['grupos', 'instituicao', 'users', 'team', 'assinatura'])->get());
    }

    public function store(StoreUserAlertRequest $request)
    {
        $userAlert = UserAlert::create($request->all());
        $userAlert->grupos()->sync($request->input('grupos', []));
        $userAlert->users()->sync($request->input('users', []));
        foreach ($request->input('anexos', []) as $file) {
            $userAlert->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexos');
        }

        return (new UserAlertResource($userAlert))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserAlertResource($userAlert->load(['grupos', 'instituicao', 'users', 'team', 'assinatura']));
    }

    public function update(UpdateUserAlertRequest $request, UserAlert $userAlert)
    {
        $userAlert->update($request->all());
        $userAlert->grupos()->sync($request->input('grupos', []));
        $userAlert->users()->sync($request->input('users', []));
        if (count($userAlert->anexos) > 0) {
            foreach ($userAlert->anexos as $media) {
                if (!in_array($media->file_name, $request->input('anexos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $userAlert->anexos->pluck('file_name')->toArray();
        foreach ($request->input('anexos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $userAlert->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexos');
            }
        }

        return (new UserAlertResource($userAlert))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserAlert $userAlert)
    {
        abort_if(Gate::denies('user_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAlert->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
