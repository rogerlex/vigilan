<?php

namespace App\Http\Requests;

use App\Models\Origen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrigenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('origen_create');
    }

    public function rules()
    {
        return [
            'origem' => [
                'string',
                'required',
                'unique:origens',
            ],
        ];
    }
}
