<?php

namespace App\Http\Requests;

use App\Models\Rematricula;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRematriculaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rematricula_create');
    }

    public function rules()
    {
        return [
            'ano' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'escola_id' => [
                'required',
                'integer',
            ],
            'turma_id' => [
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
            'turma_nova_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
