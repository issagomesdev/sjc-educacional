<?php

namespace App\Http\Requests;

use App\Models\Rotum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRotumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rotum_edit');
    }

    public function rules()
    {
        return [
            'ano' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'horario_de_saida' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'origem' => [
                'string',
                'nullable',
            ],
            'horario_de_destino' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'destino' => [
                'string',
                'nullable',
            ],
            'quilometros_percorridos' => [
                'string',
                'nullable',
            ],
        ];
    }
}
