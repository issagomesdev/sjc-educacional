<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRotumRequest;
use App\Http\Requests\UpdateRotumRequest;
use App\Http\Resources\Admin\RotumResource;
use App\Models\Rotum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RotasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('rotum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RotumResource(Rotum::with(['veiculo_responsavel', 'motorista_responsavel', 'team', 'assinatura'])->get());
    }

    public function store(StoreRotumRequest $request)
    {
        $rotum = Rotum::create($request->all());

        return (new RotumResource($rotum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rotum $rotum)
    {
        abort_if(Gate::denies('rotum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RotumResource($rotum->load(['veiculo_responsavel', 'motorista_responsavel', 'team', 'assinatura']));
    }

    public function update(UpdateRotumRequest $request, Rotum $rotum)
    {
        $rotum->update($request->all());

        return (new RotumResource($rotum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rotum $rotum)
    {
        abort_if(Gate::denies('rotum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rotum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
