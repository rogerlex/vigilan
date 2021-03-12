@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tipoProcesso.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tipo-processos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tipoProcesso.fields.id') }}
                        </th>
                        <td>
                            {{ $tipoProcesso->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tipoProcesso.fields.tipoprocesso') }}
                        </th>
                        <td>
                            {{ $tipoProcesso->tipoprocesso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tipoProcesso.fields.descricaotipoprocesso') }}
                        </th>
                        <td>
                            {{ $tipoProcesso->descricaotipoprocesso }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tipo-processos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection