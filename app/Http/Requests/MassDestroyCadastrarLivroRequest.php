<?php

namespace App\Http\Requests;

use App\Models\CadastrarLivro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCadastrarLivroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cadastrar_livro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cadastrar_livros,id',
        ];
    }
}
