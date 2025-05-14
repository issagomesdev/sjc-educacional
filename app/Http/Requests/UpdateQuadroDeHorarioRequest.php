<?php

namespace App\Http\Requests;

use App\Models\QuadroDeHorario;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuadroDeHorarioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('quadro_de_horario_edit');
    }

    public function rules()
    {
        return [
            'horario' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
