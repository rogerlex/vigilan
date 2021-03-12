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
                            {{ trans('cruds.estabelecimento.fields.natureza') }}
                        </th>
                        <td>
                            {{ $estabelecimento->natureza }}
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
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.atvprincipal') }}
                        </th>
                        <td>
                            {{ $estabelecimento->atvprincipal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.atvsecundaria') }}
                        </th>
                        <td>
                            {{ $estabelecimento->atvsecundaria }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.logradouro') }}
                        </th>
                        <td>
                            {{ $estabelecimento->logradouro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.numero') }}
                        </th>
                        <td>
                            {{ $estabelecimento->numero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.referencia') }}
                        </th>
                        <td>
                            {{ $estabelecimento->referencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.bairro') }}
                        </th>
                        <td>
                            {{ $estabelecimento->bairro->nome ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.uf') }}
                        </th>
                        <td>
                            {{ $estabelecimento->uf }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.municipio') }}
                        </th>
                        <td>
                            {{ $estabelecimento->municipio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.responsavel') }}
                        </th>
                        <td>
                            {{ $estabelecimento->responsavel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.foneresponsavel') }}
                        </th>
                        <td>
                            {{ $estabelecimento->foneresponsavel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.cpfresponsavel') }}
                        </th>
                        <td>
                            {{ $estabelecimento->cpfresponsavel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.wattsapp') }}
                        </th>
                        <td>
                            {{ $estabelecimento->wattsapp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.email') }}
                        </th>
                        <td>
                            {{ $estabelecimento->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estabelecimento.fields.situacao') }}
                        </th>
                        <td>
                            {{ $estabelecimento->situacao }}
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