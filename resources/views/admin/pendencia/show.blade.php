@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pendencium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pendencia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pendencium.fields.id') }}
                        </th>
                        <td>
                            {{ $pendencium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pendencium.fields.idestabelecimento') }}
                        </th>
                        <td>
                            {{ $pendencium->idestabelecimento->razaosocial ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pendencium.fields.prazo') }}
                        </th>
                        <td>
                            {{ $pendencium->prazo }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pendencia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection