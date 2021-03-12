<?php

namespace App\Http\Requests;

use App\Models\Denuncium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDenunciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('denuncium_create');
    }

    public function rules()
    {
        return [
            'data_denuncia'       => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'denunciante'         => [
                'string',
                'nullable',
            ],
            'contato_denunciante' => [
                'string',
                'nullable',
            ],
            'categories.*'        => [
                'integer',
            ],
            'categories'          => [
                'required',
                'array',
            ],
            'tags.*'              => [
                'integer',
            ],
            'tags'                => [
                'required',
                'array',
            ],
            'data_conclusao'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
