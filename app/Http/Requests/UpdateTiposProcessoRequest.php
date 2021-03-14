<?php

namespace App\Http\Requests;

use App\Models\TiposProcesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTiposProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipos_processo_edit');
    }

    public function rules()
    {
        return [
            'tipoprocesso' => [
                'string',
                'required',
                'unique:tipos_processos,tipoprocesso,' . request()->route('tipos_processo')->id,
            ],
        ];
    }
}
