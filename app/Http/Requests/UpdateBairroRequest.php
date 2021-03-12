<?php

namespace App\Http\Requests;

use App\Models\Bairro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBairroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bairro_edit');
    }

    public function rules()
    {
        return [
            'nome' => [
                'string',
                'nullable',
            ],
        ];
    }
}
