<?php

namespace App\Http\Requests;

use App\Models\ConteudosCurriculare;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConteudosCurriculareRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('conteudos_curriculare_create');
    }

    public function rules()
    {
        return [
          
        ];
    }
}
