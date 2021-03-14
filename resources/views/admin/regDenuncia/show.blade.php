@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.regDenuncium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reg-denuncia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.id') }}
                        </th>
                        <td>
                            {{ $regDenuncium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.data_denuncia') }}
                        </th>
                        <td>
                            {{ $regDenuncium->data_denuncia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.denunciante') }}
                        </th>
                        <td>
                            {{ $regDenuncium->denunciante }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.contato') }}
                        </th>
                        <td>
                            {{ $regDenuncium->contato }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.descricao') }}
                        </th>
                        <td>
                            {!! $regDenuncium->descricao !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.origem') }}
                        </th>
                        <td>
                            {{ $regDenuncium->origem->tag ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.imagens') }}
                        </th>
                        <td>
                            @if($regDenuncium->imagens)
                                <a href="{{ $regDenuncium->imagens->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $regDenuncium->imagens->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.anexo') }}
                        </th>
                        <td>
                            @if($regDenuncium->anexo)
                                <a href="{{ $regDenuncium->anexo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.status') }}
                        </th>
                        <td>
                            {{ $regDenuncium->status->status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reg-denuncia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection