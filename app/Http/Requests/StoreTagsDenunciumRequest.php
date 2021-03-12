<?php

namespace App\Http\Requests;

use App\Models\TagsDenuncium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTagsDenunciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tags_denuncium_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:tags_denuncia',
            ],
        ];
    }
}
