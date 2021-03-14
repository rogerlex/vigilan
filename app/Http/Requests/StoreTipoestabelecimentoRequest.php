<?php

namespace App\Http\Requests;

use App\Models\Tipoestabelecimento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTipoestabelecimentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipoestabelecimento_create');
    }

    public function rules()
    {
        return [
            'tipoestabelecimento' => [
                'string',
                'required',
                'unique:tipoestabelecimentos',
            ],
        ];
    }
}
