<?php

namespace App\Http\Requests;

use App\Models\TipoProcesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_processo_edit');
    }

    public function rules()
    {
        return [
            'tipoprocesso'          => [
                'string',
                'required',
                'unique:tipo_processos,tipoprocesso,' . request()->route('tipo_processo')->id,
            ],
            'descricaotipoprocesso' => [
                'string',
                'nullable',
            ],
        ];
    }
}
