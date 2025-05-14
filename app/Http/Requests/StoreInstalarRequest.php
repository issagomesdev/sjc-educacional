<?php

namespace App\Http\Requests;

use App\Models\Instalar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstalarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instalar_create');
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
            'instituicao_id' => [
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
        ];
    }
}
