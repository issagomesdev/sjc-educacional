<?php

namespace App\Http\Requests;

use App\Models\TipoDeTurma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoDeTurmaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_de_turma_edit');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'required',
            ],
            'sobre' => [
                'string',
                'nullable',
            ],
        ];
    }
}
