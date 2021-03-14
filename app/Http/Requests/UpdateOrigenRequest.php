<?php

namespace App\Http\Requests;

use App\Models\Origen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrigenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('origen_edit');
    }

    public function rules()
    {
        return [
            'origem' => [
                'string',
                'required',
                'unique:origens,origem,' . request()->route('origen')->id,
            ],
        ];
    }
}
