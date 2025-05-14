<?php

namespace App\Http\Requests;

use App\Models\Profissionai;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProfissionaiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('profissional_create');
    }

    public function rules()
    {
        return [
            'nome_completo' => [
                'string',
                'required',
            ],
            'data_de_nascimento' => [
                'date_format:' . config('panel.date_format'),
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
            'numero_de_contato' => [
                'string',
                'nullable',
            ],
            'e_mail_de_contato' => [
                'string',
                'nullable',
            ],
            'arquivos_relacionados' => [
                'array',
            ],
        ];
    }
}
