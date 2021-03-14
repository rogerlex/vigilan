<?php

namespace App\Http\Requests;

use App\Models\Cargo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCargoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cargo_edit');
    }

    public function rules()
    {
        return [
            'gargo' => [
                'string',
                'required',
                'unique:cargos,gargo,' . request()->route('cargo')->id,
            ],
        ];
    }
}
