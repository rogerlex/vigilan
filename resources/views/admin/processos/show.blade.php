@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.processo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.processos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.id') }}
                        </th>
                        <td>
                            {{ $processo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.tipoprocesso') }}
                        </th>
                        <td>
                            {{ $processo->tipoprocesso->tipoprocesso ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.inicio_processo') }}
                        </th>
                        <td>
                            {{ $processo->inicio_processo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.final_processo') }}
                        </th>
                        <td>
                            {{ $processo->final_processo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.solicitante') }}
                        </th>
                        <td>
                            {{ $processo->solicitante }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.email') }}
                        </th>
                        <td>
                            {{ $processo->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.anexo_processo') }}
                        </th>
                        <td>
                            @foreach($processo->anexo_processo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.estabelecimento') }}
                        </th>
                        <td>
                            @foreach($processo->estabelecimentos as $key => $estabelecimento)
                                <span class="label label-info">{{ $estabelecimento->cnpj }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.status_processo') }}
                        </th>
                        <td>
                            {{ $processo->status_processo->status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.processos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection