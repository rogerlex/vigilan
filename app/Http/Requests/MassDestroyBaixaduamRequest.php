<?php

namespace App\Http\Requests;

use App\Models\Baixaduam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBaixaduamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('baixaduam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:baixaduams,id',
        ];
    }
}
