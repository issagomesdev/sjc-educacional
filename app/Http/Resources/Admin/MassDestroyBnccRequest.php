<?php

namespace App\Http\Requests;

use App\Models\Bncc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBnccRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bncc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bnccs,id',
        ];
    }
}
