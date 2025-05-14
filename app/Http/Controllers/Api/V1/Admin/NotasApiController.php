<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotumRequest;
use App\Http\Requests\UpdateNotumRequest;
use App\Http\Resources\Admin\NotumResource;
use App\Models\Notum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NotumResource(Notum::with(['disciplina', 'escola', 'turma', 'alunos', 'team', 'assinatura'])->get());
    }

    public function store(StoreNotumRequest $request)
    {
        $notum = Notum::create($request->all());

        return (new NotumResource($notum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Notum $notum)
    {
        abort_if(Gate::denies('notum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NotumResource($notum->load(['disciplina', 'escola', 'turma', 'alunos', 'team', 'assinatura']));
    }

    public function update(UpdateNotumRequest $request, Notum $notum)
    {
        $notum->update($request->all());

        return (new NotumResource($notum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Notum $notum)
    {
        abort_if(Gate::denies('notum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
