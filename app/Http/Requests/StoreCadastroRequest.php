<?php

namespace App\Http\Requests;

use App\Models\Cadastro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCadastroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastro_create');
    }

    public function rules()
    {
        return [
            'nome_completo' => [
                'string',
                'required',
            ],
            'data_de_nascimento' => [
                'nullable',
            ],
            'nacionalidade' => [
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
            'e_mail_de_contato' => [
                'string',
                'nullable',
            ],
            'certidao_de_nascimento' => [
                'string',
                'nullable',
            ],
            'numero_do_nis' => [
                'string',
                'nullable',
            ],
            'numero_do_cpf' => [
                'string',
                'nullable',
            ],
            'numero_da_identidade' => [
                'string',
                'nullable',
            ],
            'numero_de_telefone' => [
                'string',
                'nullable',
            ],
            'ocupacao_do_aluno' => [
                'string',
                'nullable',
            ],
            'nome_responsavel' => [
                'string',
                'nullable',
            ],
            'profissao_do_responsavel' => [
                'string',
                'nullable',
            ],
            'contato_de_emergencia' => [
                'string',
                'nullable',
            ],
            'nome_do_responsavel_2' => [
                'string',
                'nullable',
            ],
            'profissao_do_responsavel_2' => [
                'string',
                'nullable',
            ],
            'contato_de_emergencia_2' => [
                'string',
                'nullable',
            ],
            'tipo_sanguineo' => [
                'string',
                'nullable',
            ],
            'sesim_qual' => [
                'string',
                'nullable',
            ],
            'sesim_qual_2' => [
                'string',
                'nullable',
            ],
            'sesim_qual_3' => [
                'string',
                'nullable',
            ],
            'sesim_qual_4' => [
                'string',
                'nullable',
            ],
            'arquivos_relacionados' => [
                'array',
            ],
        ];
    }
}
