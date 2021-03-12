<?php

namespace App\Http\Requests;

use App\Models\Denunciacategorium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDenunciacategoriumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('denunciacategorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:denunciacategoria,id',
        ];
    }
}
