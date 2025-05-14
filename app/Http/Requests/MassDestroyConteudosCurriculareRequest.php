<?php

namespace App\Http\Requests;

use App\Models\ConteudosCurriculare;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConteudosCurriculareRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('conteudos_curriculare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:conteudos_curriculares,id',
        ];
    }
}
