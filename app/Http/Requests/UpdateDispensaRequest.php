<?php

namespace App\Http\Requests;

use App\Models\Dispensa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDispensaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dispensa_edit');
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
            'disciplinas.*' => [
                'integer',
            ],
            'disciplinas' => [
                'required',
                'array',
            ],
            'motivo' => [
                'string',
                'nullable',
            ],
            'alunos.*' => [
                'integer',
            ],
            'alunos' => [
                'array',
            ],
        ];
    }
}
