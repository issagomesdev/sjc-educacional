<?php

namespace App\Http\Requests;

use App\Models\Transferencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransferenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transferencium_edit');
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
            'escola_anterior_id' => [
                'required',
                'integer',
            ],
            'turma_anterior_id' => [
                'required',
                'integer',
            ],
            'alunos.*' => [
                'integer',
            ],
            'alunos' => [
                'required',
                'array',
            ],
            'escola_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
