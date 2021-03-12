<?php

namespace App\Http\Requests;

use App\Models\TipoEstabelecimento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoEstabelecimentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipo_estabelecimento_edit');
    }

    public function rules()
    {
        return [
            'categoriaestabelecimento' => [
                'string',
                'required',
                'unique:tipo_estabelecimentos,categoriaestabelecimento,' . request()->route('tipo_estabelecimento')->id,
            ],
        ];
    }
}
