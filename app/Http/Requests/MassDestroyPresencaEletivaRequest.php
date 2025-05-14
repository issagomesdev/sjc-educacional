<?php

namespace App\Http\Requests;

use App\Models\PresencaEletiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPresencaEletivaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('presenca_eletiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:presenca_eletivas,id',
        ];
    }
}
