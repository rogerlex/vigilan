<?php

namespace App\Http\Requests;

use App\Models\Identidadegenero;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIdentidadegeneroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('identidadegenero_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:identidadegeneros,id',
        ];
    }
}
