<?php

namespace App\Http\Requests;

use App\Models\Bncc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBnccRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bncc_create');
    }

    public function rules()
    {
        return [
            'codigo' => [
                'string',
                'nullable',
            ],
            'series.*' => [
                'integer',
            ],
            'series' => [
                'array',
            ],
            'unidade_tematica' => [
                'string',
                'nullable',
            ],
        ];
    }
}
