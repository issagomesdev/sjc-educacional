<?php

namespace App\Http\Requests;

use App\Models\Transferencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransferenciumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transferencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transferencia,id',
        ];
    }
}
