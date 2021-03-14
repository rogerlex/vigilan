@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.colaboradore.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.colaboradores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.colaboradore.fields.id') }}
                        </th>
                        <td>
                            {{ $colaboradore->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.colaboradore.fields.nome') }}
                        </th>
                        <td>
                            {{ $colaboradore->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.colaboradore.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Colaboradore::STATUS_SELECT[$colaboradore->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.colaboradores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection