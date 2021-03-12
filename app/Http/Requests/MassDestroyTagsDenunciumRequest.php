<?php

namespace App\Http\Requests;

use App\Models\TagsDenuncium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTagsDenunciumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tags_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tags_denuncia,id',
        ];
    }
}
