<?php

namespace App\Http\Requests;

use App\Models\BancoDeAula;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBancoDeAulaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banco_de_aula_create');
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
