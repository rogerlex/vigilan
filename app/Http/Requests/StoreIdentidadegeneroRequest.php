<?php

namespace App\Http\Requests;

use App\Models\Identidadegenero;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIdentidadegeneroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('identidadegenero_create');
    }

    public function rules()
    {
        return [
            'genero' => [
                'string',
                'required',
                'unique:identidadegeneros',
            ],
        ];
    }
}
