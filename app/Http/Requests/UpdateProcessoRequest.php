<?php

namespace App\Http\Requests;

use App\Models\Processo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('processo_edit');
    }

    public function rules()
    {
        return [
            'inicio'                 => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'fim'                    => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'solicitante'            => [
                'string',
                'required',
            ],
            'tipoestabelecimento_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
