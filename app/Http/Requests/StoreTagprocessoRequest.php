<?php

namespace App\Http\Requests;

use App\Models\Tagprocesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTagprocessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tagprocesso_create');
    }

    public function rules()
    {
        return [
            'nome' => [
                'string',
                'required',
                'unique:tagprocessos',
            ],
        ];
    }
}
