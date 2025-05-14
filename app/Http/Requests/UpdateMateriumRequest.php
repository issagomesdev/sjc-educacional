<?php

namespace App\Http\Requests;

use App\Models\Materium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMateriumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('materium_edit');
    }

    public function rules()
    {
        return [
            'bncc' => [
                'string',
                'nullable',
            ],
            'nome_da_materia' => [
                'string',
                'nullable',
            ],
        ];
    }
}
