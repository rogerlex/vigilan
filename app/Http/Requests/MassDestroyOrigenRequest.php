<?php

namespace App\Http\Requests;

use App\Models\Origen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrigenRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('origen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:origens,id',
        ];
    }
}
