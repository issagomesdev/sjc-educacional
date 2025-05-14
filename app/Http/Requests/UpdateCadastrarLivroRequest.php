<?php

namespace App\Http\Requests;

use App\Models\CadastrarLivro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCadastrarLivroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cadastrar_livro_edit');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
            'autor' => [
                'string',
                'nullable',
            ],
            'idioma' => [
                'string',
                'nullable',
            ],
            'ano' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'editora' => [
                'string',
                'nullable',
            ],
            'assunto' => [
                'string',
                'nullable',
            ],
            'materias_relacionadas.*' => [
                'integer',
            ],
            'materias_relacionadas' => [
                'array',
            ],
            'exemplares_existentes' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'isbn' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cdd' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
