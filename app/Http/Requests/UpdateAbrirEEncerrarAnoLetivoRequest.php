<?php

namespace App\Http\Requests;

use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAbrirEEncerrarAnoLetivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('abrir_e_encerrar_ano_letivo_edit');
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
        ];
    }
}
