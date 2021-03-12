<?php

namespace App\Http\Requests;

use App\Models\Processo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProcessoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:processos,id',
        ];
    }
}
