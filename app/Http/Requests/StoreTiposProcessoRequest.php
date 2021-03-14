<?php

namespace App\Http\Requests;

use App\Models\TiposProcesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTiposProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipos_processo_create');
    }

    public function rules()
    {
        return [
            'tipoprocesso' => [
                'string',
                'required',
                'unique:tipos_processos',
            ],
        ];
    }
}
