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
            'final_processo'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
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
