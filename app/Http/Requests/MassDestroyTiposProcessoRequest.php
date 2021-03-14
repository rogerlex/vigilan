<?php

namespace App\Http\Requests;

use App\Models\TiposProcesso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTiposProcessoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tipos_processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tipos_processos,id',
        ];
    }
}
