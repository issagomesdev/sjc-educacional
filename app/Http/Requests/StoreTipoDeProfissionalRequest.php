<?php

namespace App\Http\Requests;

use App\Models\TipoDeProfissional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTipoDeProfissionalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_de_profissional_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
            'sobre' => [
                'string',
                'nullable',
            ],
        ];
    }
}
