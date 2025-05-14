<?php

namespace App\Http\Requests;

use App\Models\TipoDeProfissional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoDeProfissionalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_de_profissional_edit');
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
