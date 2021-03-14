@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.estabelecimento.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estabelecimentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.id') }}
                        </th>
                        <td>
                            {{ $estabelecimento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.cnpj') }}
                        </th>
                        <td>
                            {{ $estabelecimento->cnpj }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.razaosocial') }}
                        </th>
                        <td>
                            {{ $estabelecimento->razaosocial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.nomefantasia') }}
                        </th>
                        <td>
                            {{ $estabelecimento->nomefantasia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.natureza_do_estabelecimento') }}
                        </th>
                        <td>
                            {{ $estabelecimento->natureza_do_estabelecimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.tipo') }}
                        </th>
                        <td>
                            {{ $estabelecimento->tipo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.area') }}
                        </th>
                        <td>
                            {{ $estabelecimento->area }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estabelecimentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection