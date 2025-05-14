<?php

namespace App\Http\Requests;

use App\Models\BancoDeAula;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBancoDeAulaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('banco_de_aula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:banco_de_aulas,id',
        ];
    }
}
