<?php

namespace App\Http\Requests;

use App\Models\Denunciacategorium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDenunciacategoriumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('denunciacategorium_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:denunciacategoria',
            ],
        ];
    }
}
