<?php

namespace App\Http\Requests;

use App\Models\BancoDeProjeto;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBancoDeProjetoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banco_de_projeto_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'required',
            ],
            'autor' => [
                'string',
                'nullable',
            ],
            'area_de_conhecimento' => [
                'string',
                'nullable',
            ],
            'metodologia' => [
                'string',
                'nullable',
            ],
            'finalidade' => [
                'string',
                'nullable',
            ],
            'aceito' => [
                'required',
            ],
        ];
    }
}
