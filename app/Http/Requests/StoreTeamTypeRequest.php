<?php

namespace App\Http\Requests;

use App\Models\TeamType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTeamTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_type_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'required',
            ],
            'sobre' => [
                'string',
                'nullable',
            ],
        ];
    }
}
