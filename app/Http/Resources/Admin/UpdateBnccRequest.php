<?php

namespace App\Http\Requests;

use App\Models\Bncc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBnccRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bncc_edit');
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
