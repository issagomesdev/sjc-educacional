<?php

namespace App\Http\Requests;

use App\Models\Transferencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransferenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transferencium_create');
    }

    public function rules()
    {
        return [];
    }
}
