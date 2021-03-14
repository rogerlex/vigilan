<?php

namespace App\Http\Requests;

use App\Models\RegDenuncium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRegDenunciumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('reg_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:reg_denuncia,id',
        ];
    }
}
