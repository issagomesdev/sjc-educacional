<?php

namespace App\Http\Requests;

use App\Models\AbrirEEncerrarAnoLetivo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAbrirEEncerrarAnoLetivoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('abrir_e_encerrar_ano_letivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:abrir_e_encerrar_ano_letivos,id',
        ];
    }
}
