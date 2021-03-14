<?php

namespace App\Http\Requests;

use App\Models\Pendencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePendenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pendencium_edit');
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
