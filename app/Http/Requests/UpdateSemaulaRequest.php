<?php

namespace App\Http\Requests;

use App\Models\Semaula;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSemaulaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('semaula_edit');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
        ];
    }
}
