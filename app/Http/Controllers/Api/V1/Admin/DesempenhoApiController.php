<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesempenhoRequest;
use App\Http\Requests\UpdateDesempenhoRequest;
use App\Http\Resources\Admin\DesempenhoResource;
use App\Models\Desempenho;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DesempenhoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('desempenho_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesempenhoResource(Desempenho::all());
    }

    public function store(StoreDesempenhoRequest $request)
    {
        $desempenho = Desempenho::create($request->all());

        return (new DesempenhoResource($desempenho))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Desempenho $desempenho)
    {
        abort_if(Gate::denies('desempenho_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesempenhoResource($desempenho);
    }

    public function update(UpdateDesempenhoRequest $request, Desempenho $desempenho)
    {
        $desempenho->update($request->all());

        return (new DesempenhoResource($desempenho))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Desempenho $desempenho)
    {
        abort_if(Gate::denies('desempenho_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $desempenho->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
