<?php

namespace App\Http\Requests;

use App\Models\Formacao;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFormacaoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('formacao_create');
    }

    public function rules()
    {
        return [
            'formacao' => [
                'string',
                'required',
                'unique:formacaos',
            ],
        ];
    }
}
