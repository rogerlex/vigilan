<?php

namespace App\Http\Requests;

use App\Models\Colaboradore;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreColaboradoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('colaboradore_create');
    }

    public function rules()
    {
        return [
            'nome'            => [
                'string',
                'required',
                'unique:colaboradores',
            ],
            'cpf'             => [
                'string',
                'required',
                'unique:colaboradores',
            ],
            'genero_id'       => [
                'required',
                'integer',
            ],
            'telefone'        => [
                'string',
                'nullable',
            ],
            'formacao_id'     => [
                'required',
                'integer',
            ],
            'cargo_id'        => [
                'required',
                'integer',
            ],
            'status'          => [
                'required',
            ],
            'departamentos.*' => [
                'integer',
            ],
            'departamentos'   => [
                'array',
            ],
        ];
    }
}
