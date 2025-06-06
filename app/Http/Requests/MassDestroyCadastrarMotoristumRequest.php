<?php

namespace App\Http\Requests;

use App\Models\CadastrarMotoristum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCadastrarMotoristumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cadastrar_motoristum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cadastrar_motorista,id',
        ];
    }
}
