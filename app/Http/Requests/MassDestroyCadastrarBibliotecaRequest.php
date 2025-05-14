<?php

namespace App\Http\Requests;

use App\Models\CadastrarBiblioteca;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCadastrarBibliotecaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cadastrar_biblioteca_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cadastrar_bibliotecas,id',
        ];
    }
}
