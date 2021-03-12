<?php

namespace App\Http\Requests;

use App\Models\TipoProcesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTipoProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_processo_create');
    }

    public function rules()
    {
        return [
            'tipoprocesso'          => [
                'string',
                'required',
                'unique:tipo_processos',
            ],
            'descricaotipoprocesso' => [
                'string',
                'nullable',
            ],
        ];
    }
}
