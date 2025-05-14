<?php

namespace App\Http\Requests;

use App\Models\Deslocar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDeslocarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('deslocar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:deslocars,id',
        ];
    }
}
