<?php

namespace App\Http\Requests;

use App\Models\Notum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNotumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notum_edit');
    }

    public function rules()
    {
        return [
            'unidade_1' => [
                'string',
                'nullable',
            ],
            'unidade_2' => [
                'string',
                'nullable',
            ],
            'unidade_1_rec' => [
                'string',
                'nullable',
            ],
            'unidade_2_rec' => [
                'string',
                'nullable',
            ],
            'unidade_3' => [
                'string',
                'nullable',
            ],
            'unidade_4' => [
                'string',
                'nullable',
            ],
            'unidade_3_rec' => [
                'string',
                'nullable',
            ],
            'unidade_4_rec' => [
                'string',
                'nullable',
            ],
            'media_anual' => [
                'string',
                'nullable',
            ],
            'nota_da_rec_final' => [
                'string',
                'nullable',
            ],
            'media_apos_rec_final' => [
                'string',
                'nullable',
            ],
            'conselho_de_classe' => [
                'string',
                'nullable',
            ],
            'media_final' => [
                'string',
                'nullable',
            ],
        ];
    }
}
