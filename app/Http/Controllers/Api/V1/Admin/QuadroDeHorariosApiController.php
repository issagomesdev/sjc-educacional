<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuadroDeHorarioRequest;
use App\Http\Requests\UpdateQuadroDeHorarioRequest;
use App\Http\Resources\Admin\QuadroDeHorarioResource;
use App\Models\QuadroDeHorario;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuadroDeHorariosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quadro_de_horario_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuadroDeHorarioResource(QuadroDeHorario::with(['escola', 'ano_serie', 'materias', 'professor', 'team', 'assinatura'])->get());
    }

    public function store(StoreQuadroDeHorarioRequest $request)
    {
        $quadroDeHorario = QuadroDeHorario::create($request->all());

        return (new QuadroDeHorarioResource($quadroDeHorario))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QuadroDeHorario $quadroDeHorario)
    {
        abort_if(Gate::denies('quadro_de_horario_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuadroDeHorarioResource($quadroDeHorario->load(['escola', 'ano_serie', 'materias', 'professor', 'team', 'assinatura']));
    }

    public function update(UpdateQuadroDeHorarioRequest $request, QuadroDeHorario $quadroDeHorario)
    {
        $quadroDeHorario->update($request->all());

        return (new QuadroDeHorarioResource($quadroDeHorario))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QuadroDeHorario $quadroDeHorario)
    {
        abort_if(Gate::denies('quadro_de_horario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quadroDeHorario->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
