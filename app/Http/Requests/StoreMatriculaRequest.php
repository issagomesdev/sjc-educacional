<?php

namespace App\Http\Requests;

use App\Models\Matricula;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMatriculaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('matricula_create');
    }

    public function rules()
    {
        return [ ];
    }
}
