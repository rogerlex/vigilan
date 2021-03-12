<?php

namespace App\Http\Requests;

use App\Models\Estabelecimento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEstabelecimentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estabelecimento_edit');
    }

    public function rules()
    {
        return [
            'cnpj'            => [
                'string',
                'required',
                'unique:estabelecimentos,cnpj,' . request()->route('estabelecimento')->id,
            ],
            'razaosocial'     => [
                'string',
                'required',
            ],
            'nomefantasia'    => [
                'string',
                'nullable',
            ],
            'natureza'        => [
                'string',
                'nullable',
            ],
            'tipo'            => [
                'string',
                'nullable',
            ],
            'area'            => [
                'numeric',
            ],
            'atvprincipal'    => [
                'string',
                'nullable',
            ],
            'atvsecundaria'   => [
                'string',
                'nullable',
            ],
            'logradouro'      => [
                'string',
                'nullable',
            ],
            'numero'          => [
                'string',
                'nullable',
            ],
            'referencia'      => [
                'string',
                'nullable',
            ],
            'uf'              => [
                'string',
                'nullable',
            ],
            'municipio'       => [
                'string',
                'nullable',
            ],
            'responsavel'     => [
                'string',
                'nullable',
            ],
            'foneresponsavel' => [
                'string',
                'nullable',
            ],
            'cpfresponsavel'  => [
                'string',
                'nullable',
            ],
            'wattsapp'        => [
                'string',
                'nullable',
            ],
            'situacao'        => [
                'string',
                'nullable',
            ],
        ];
    }
}
