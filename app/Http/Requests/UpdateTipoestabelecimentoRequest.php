<?php

namespace App\Http\Requests;

use App\Models\Tipoestabelecimento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoestabelecimentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipoestabelecimento_edit');
    }

    public function rules()
    {
        return [
            'tipoestabelecimento' => [
                'string',
                'required',
                'unique:tipoestabelecimentos,tipoestabelecimento,' . request()->route('tipoestabelecimento')->id,
            ],
        ];
    }
}
