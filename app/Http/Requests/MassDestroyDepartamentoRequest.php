<?php

namespace App\Http\Requests;

use App\Models\Departamento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepartamentoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('departamento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:departamentos,id',
        ];
    }
}
