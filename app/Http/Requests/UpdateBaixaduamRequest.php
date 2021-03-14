<?php

namespace App\Http\Requests;

use App\Models\Baixaduam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBaixaduamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('baixaduam_edit');
    }

    public function rules()
    {
        return [
            'processos.*'    => [
                'integer',
            ],
            'processos'      => [
                'required',
                'array',
            ],
            'id_duam'        => [
                'string',
                'required',
            ],
            'data_emissao'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'data_pagamento' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'valorpago'      => [
                'numeric',
                'required',
            ],
        ];
    }
}
