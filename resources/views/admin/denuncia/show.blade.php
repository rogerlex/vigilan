@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.denuncium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.denuncia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.id') }}
                        </th>
                        <td>
                            {{ $denuncium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.data_denuncia') }}
                        </th>
                        <td>
                            {{ $denuncium->data_denuncia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.denunciante') }}
                        </th>
                        <td>
                            {{ $denuncium->denunciante }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.contato_denunciante') }}
                        </th>
                        <td>
                            {{ $denuncium->contato_denunciante }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.description') }}
                        </th>
                        <td>
                            {!! $denuncium->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.category') }}
                        </th>
                        <td>
                            @foreach($denuncium->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.tag') }}
                        </th>
                        <td>
                            @foreach($denuncium->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.photo') }}
                        </th>
                        <td>
                            @foreach($denuncium->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.tratativa') }}
                        </th>
                        <td>
                            {!! $denuncium->tratativa !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Denuncium::STATUS_SELECT[$denuncium->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.denuncium.fields.data_conclusao') }}
                        </th>
                        <td>
                            {{ $denuncium->data_conclusao }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.denuncia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection