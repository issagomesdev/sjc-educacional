<?php

namespace App\Http\Requests;

use App\Models\PresencaEletiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePresencaEletivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('presenca_eletiva_create');
    }

    public function rules()
    {
        return [
            'data' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
