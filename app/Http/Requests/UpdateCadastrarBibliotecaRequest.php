<?php

namespace App\Http\Requests;

use App\Models\CadastrarBiblioteca;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCadastrarBibliotecaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastrar_biblioteca_edit');
    }

    public function rules()
    {
        return [
            'nome_da_biblioteca' => [
                'string',
                'required',
            ],
            'cidade' => [
                'string',
                'nullable',
            ],
            'bairro' => [
                'string',
                'nullable',
            ],
            'endereco' => [
                'string',
                'nullable',
            ],
            'horario_1' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_1_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_2_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_3' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_3_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_4' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_4_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_5' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_5_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_6' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_6_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_7' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horario_7_2' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
