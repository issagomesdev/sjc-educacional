<?php

namespace App\Http\Requests;

use App\Models\Deslocar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeslocarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('deslocar_edit');
    }

    public function rules()
    {
        return [
            'ano' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'institucao_1_id' => [
                'required',
                'integer',
            ],
            'funcao_id' => [
                'required',
                'integer',
            ],
            'profissional_id' => [
                'required',
                'integer',
            ],
            'institucao_2_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
