<?php

namespace App\Http\Requests;

use App\Models\PlanejamentoBimestral;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPlanejamentoBimestralRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('planejamento_bimestral_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:planejamento_bimestrals,id',
        ];
    }
}
