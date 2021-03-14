<?php

namespace App\Http\Requests;

use App\Models\Colaboradore;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateColaboradoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('colaboradore_edit');
    }

    public function rules()
    {
        return [
            'nome'            => [
                'string',
                'required',
                'unique:colaboradores,nome,' . request()->route('colaboradore')->id,
            ],
            'cpf'             => [
                'string',
                'required',
                'unique:colaboradores,cpf,' . request()->route('colaboradore')->id,
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
