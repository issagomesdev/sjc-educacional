<?php

namespace App\Http\Requests;

use App\Models\Turma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTurmaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('turma_create');
    }

    public function rules()
    {
        return [
            'ano_serie' => [
                'string',
                'nullable',
            ],
        ];
    }
}
