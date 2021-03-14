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
            'cnpj'                        => [
                'string',
                'required',
                'unique:estabelecimentos,cnpj,' . request()->route('estabelecimento')->id,
            ],
            'razaosocial'                 => [
                'string',
                'min:3',
                'required',
            ],
            'nomefantasia'                => [
                'string',
                'min:3',
                'required',
            ],
            'natureza_do_estabelecimento' => [
                'string',
                'required',
            ],
            'tipo'                        => [
                'string',
                'nullable',
            ],
            'area'                        => [
                'numeric',
            ],
            'atividade_principal'         => [
                'string',
                'required',
            ],
            'logradouro'                  => [
                'string',
                'required',
            ],
            'numero'                      => [
                'string',
                'nullable',
            ],
            'ponto_de_referencia'         => [
                'string',
                'nullable',
            ],
            'bairro_id'                   => [
                'required',
                'integer',
            ],
            'municipio'                   => [
                'string',
                'required',
            ],
            'uf'                          => [
                'string',
                'required',
            ],
            'responsavel_tecnico'         => [
                'string',
                'nullable',
            ],
            'cpf'                         => [
                'string',
                'max:14',
                'nullable',
            ],
            'contato'                     => [
                'string',
                'nullable',
            ],
            'situacao'                    => [
                'string',
                'required',
            ],
        ];
    }
}
