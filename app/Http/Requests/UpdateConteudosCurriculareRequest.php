<?php

namespace App\Http\Requests;

use App\Models\ConteudosCurriculare;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateConteudosCurriculareRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('conteudos_curriculare_edit');
    }

    public function rules()
    {
        return [

        ];
    }
}
