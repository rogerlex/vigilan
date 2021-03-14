<?php

namespace App\Http\Requests;

use App\Models\RegDenuncium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegDenunciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reg_denuncium_edit');
    }

    public function rules()
    {
        return [
            'data_denuncia' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'denunciante'   => [
                'string',
                'nullable',
            ],
            'contato'       => [
                'string',
                'nullable',
            ],
            'descricao'     => [
                'required',
            ],
            'origem_id'     => [
                'required',
                'integer',
            ],
            'categoria_id'  => [
                'required',
                'integer',
            ],
            'status_id'     => [
                'required',
                'integer',
            ],
        ];
    }
}
