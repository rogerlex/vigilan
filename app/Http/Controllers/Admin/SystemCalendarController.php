<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Denuncium',
            'date_field' => 'data_denuncia',
            'field'      => 'id',
            'prefix'     => 'Denúncia:',
            'suffix'     => '',
            'route'      => 'admin.denuncia.edit',
        ],
        [
            'model'      => '\App\Models\Processo',
            'date_field' => 'inicio',
            'field'      => 'id',
            'prefix'     => 'Processo:',
            'suffix'     => '',
            'route'      => 'admin.processos.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
