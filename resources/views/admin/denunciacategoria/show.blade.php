@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.denunciacategorium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.denunciacategoria.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.id') }}
                        </th>
                        <td>
                            {{ $denunciacategorium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.name') }}
                        </th>
                        <td>
                            {{ $denunciacategorium->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.description') }}
                        </th>
                        <td>
                            {{ $denunciacategorium->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.denunciacategoria.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection