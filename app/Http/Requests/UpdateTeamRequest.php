<?php

namespace App\Http\Requests;

use App\Models\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
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
            'cnpj' => [
                'string',
                'nullable',
            ],
            'telefone_de_contato' => [
                'string',
                'nullable',
            ],
            'telefone_de_contato_2' => [
                'string',
                'nullable',
            ],
            'telefone_de_contato_3' => [
                'string',
                'nullable',
            ],
            'email_de_contato' => [
                'string',
                'nullable',
            ],
        ];
    }
}
