<?php

namespace App\Http\Requests;

use App\Models\Cadastro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCadastroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastro_edit');
    }

    public function rules()
    {
        return [];
    }
}
