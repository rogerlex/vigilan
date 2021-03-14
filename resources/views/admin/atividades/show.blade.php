@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atividade.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atividades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atividade.fields.id') }}
                        </th>
                        <td>
                            {{ $atividade->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atividade.fields.vista_num_processo') }}
                        </th>
                        <td>
                            {{ $atividade->vista_num_processo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atividade.fields.status') }}
                        </th>
                        <td>
                            {{ $atividade->status->status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atividades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection