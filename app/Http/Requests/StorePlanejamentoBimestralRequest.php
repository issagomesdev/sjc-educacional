<?php

namespace App\Http\Requests;

use App\Models\PlanejamentoBimestral;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePlanejamentoBimestralRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('planejamento_bimestral_create');
    }

    public function rules()
    {
        return [
            'aulas_previstas' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
