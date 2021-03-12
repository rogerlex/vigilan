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
                            {{ trans('cruds.processo.fields.inicio') }}
                        </th>
                        <td>
                            {{ $processo->inicio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.fim') }}
                        </th>
                        <td>
                            {{ $processo->fim }}
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
                            {{ trans('cruds.processo.fields.emailprocesso') }}
                        </th>
                        <td>
                            {{ $processo->emailprocesso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.descricao') }}
                        </th>
                        <td>
                            {!! $processo->descricao !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.tipoestabelecimento') }}
                        </th>
                        <td>
                            {{ $processo->tipoestabelecimento->categoriaestabelecimento ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.processo.fields.anexos') }}
                        </th>
                        <td>
                            @foreach($processo->anexos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
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