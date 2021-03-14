<?php

namespace App\Http\Requests;

use App\Models\Processo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('processo_create');
    }

    public function rules()
    {
        return [
            'numero_do_processo' => [
                'string',
                'required',
            ],
            'tipoprocesso_id'    => [
                'required',
                'integer',
            ],
            'inicio_processo'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'solicitante'        => [
                'string',
                'required',
            ],
            'descricao'          => [
                'required',
            ],
            'estabelecimentos.*' => [
                'integer',
            ],
            'estabelecimentos'   => [
                'array',
            ],
            'status_processo_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
