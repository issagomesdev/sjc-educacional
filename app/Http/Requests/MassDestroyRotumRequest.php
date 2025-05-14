<?php

namespace App\Http\Requests;

use App\Models\Rotum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRotumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rotum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rota,id',
        ];
    }
}
