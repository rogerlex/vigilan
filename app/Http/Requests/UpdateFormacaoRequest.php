<?php

namespace App\Http\Requests;

use App\Models\Formacao;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFormacaoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('formacao_edit');
    }

    public function rules()
    {
        return [
            'formacao' => [
                'string',
                'required',
                'unique:formacaos,formacao,' . request()->route('formacao')->id,
            ],
        ];
    }
}
