<?php

namespace App\Http\Requests;

use App\Models\Atividade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAtividadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('atividade_create');
    }

    public function rules()
    {
        return [
            'numeroprocesso_id'      => [
                'required',
                'integer',
            ],
            'vista_num_processo'     => [
                'string',
                'nullable',
            ],
            'tipo_de_processo_id'    => [
                'required',
                'integer',
            ],
            'relatorio_da_atividade' => [
                'required',
            ],
            'equipe_responsavels.*'  => [
                'integer',
            ],
            'equipe_responsavels'    => [
                'required',
                'array',
            ],
            'status_id'              => [
                'required',
                'integer',
            ],
            'data_atividade'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
