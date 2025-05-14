<?php

namespace App\Http\Requests;

use App\Models\CadastrarMotoristum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCadastrarMotoristumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastrar_motoristum_create');
    }

    public function rules()
    {
        return [
            'nome_completo' => [
                'string',
                'nullable',
            ],
            'data_de_nascimento' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'data_da_habilitacao' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'vencimento_da_habilitacao' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'codigo_do_motorista' => [
                'string',
                'nullable',
            ],
            'cnh' => [
                'string',
                'nullable',
            ],
            'cpf' => [
                'string',
                'nullable',
            ],
            'rg' => [
                'string',
                'nullable',
            ],
            'cidade' => [
                'string',
                'nullable',
            ],
            'bairro' => [
                'string',
                'nullable',
            ],
            'endereco' => [
                'string',
                'nullable',
            ],
            'ano_de_contratacao' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'numero_de_telefone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
