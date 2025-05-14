<?php

namespace App\Http\Requests;

use App\Models\TipoDeTurma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTipoDeTurmaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tipo_de_turma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tipo_de_turmas,id',
        ];
    }
}
