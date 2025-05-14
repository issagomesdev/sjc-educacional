<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSemaulaRequest;
use App\Http\Requests\UpdateSemaulaRequest;
use App\Http\Resources\Admin\SemaulaResource;
use App\Models\Semaula;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SemaulasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('semaula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SemaulaResource(Semaula::with(['escolas', 'team', 'assinatura'])->get());
    }

    public function store(StoreSemaulaRequest $request)
    {
        $semaula = Semaula::create($request->all());
        $semaula->escolas()->sync($request->input('escolas', []));

        return (new SemaulaResource($semaula))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SemaulaResource($semaula->load(['escolas', 'team', 'assinatura']));
    }

    public function update(UpdateSemaulaRequest $request, Semaula $semaula)
    {
        $semaula->update($request->all());
        $semaula->escolas()->sync($request->input('escolas', []));

        return (new SemaulaResource($semaula))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Semaula $semaula)
    {
        abort_if(Gate::denies('semaula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semaula->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
