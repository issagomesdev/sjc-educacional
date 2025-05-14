<?php

namespace App\Http\Requests;

use App\Models\Cadastrarveiculo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCadastrarveiculoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastrarveiculo_create');
    }

    public function rules()
    {
        return [
            'niv' => [
                'string',
                'nullable',
            ],
            'placa' => [
                'string',
                'nullable',
            ],
            'renavam' => [
                'string',
                'nullable',
            ],
            'marca' => [
                'string',
                'nullable',
            ],
            'descricao' => [
                'string',
                'nullable',
            ],
            'motorista_responsavels.*' => [
                'integer',
            ],
            'motorista_responsavels' => [
                'array',
            ],
        ];
    }
}
