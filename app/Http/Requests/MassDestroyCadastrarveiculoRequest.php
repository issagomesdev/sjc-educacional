<?php

namespace App\Http\Requests;

use App\Models\Cadastrarveiculo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCadastrarveiculoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cadastrarveiculo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cadastrarveiculos,id',
        ];
    }
}
