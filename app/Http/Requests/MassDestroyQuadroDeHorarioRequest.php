<?php

namespace App\Http\Requests;

use App\Models\QuadroDeHorario;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQuadroDeHorarioRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('quadro_de_horario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:quadro_de_horarios,id',
        ];
    }
}
