<?php

namespace App\Http\Requests;

use App\Models\Pendencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePendenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pendencium_create');
    }

    public function rules()
    {
        return [
            'idestabelecimento_id' => [
                'required',
                'integer',
            ],
            'pendencia'            => [
                'required',
            ],
            'prazo'                => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
