<?php

namespace App\Http\Requests;

use App\Models\Visitum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVisitumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitum_create');
    }

    public function rules()
    {
        return [
            'motivo'             => [
                'required',
            ],
            'estabelecimentos.*' => [
                'integer',
            ],
            'estabelecimentos'   => [
                'required',
                'array',
            ],
            'dataagendamento'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'equipes.*'          => [
                'integer',
            ],
            'equipes'            => [
                'required',
                'array',
            ],
            'status_visita_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
