<?php

namespace App\Http\Requests;

use App\Models\Tagprocesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTagprocessoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tagprocesso_edit');
    }

    public function rules()
    {
        return [
            'nome' => [
                'string',
                'required',
                'unique:tagprocessos,nome,' . request()->route('tagprocesso')->id,
            ],
        ];
    }
}
