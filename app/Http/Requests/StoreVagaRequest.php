<?php

namespace App\Http\Requests;

use App\Models\Vaga;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVagaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vaga_create');
    }

    public function rules()
    {
        return [
            'total_de_vadas' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
