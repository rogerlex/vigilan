<?php

namespace App\Http\Requests;

use App\Models\Identidadegenero;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIdentidadegeneroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('identidadegenero_edit');
    }

    public function rules()
    {
        return [
            'genero' => [
                'string',
                'required',
                'unique:identidadegeneros,genero,' . request()->route('identidadegenero')->id,
            ],
        ];
    }
}
