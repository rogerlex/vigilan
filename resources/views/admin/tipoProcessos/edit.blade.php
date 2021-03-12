@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tipoProcesso.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipo-processos.update", [$tipoProcesso->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tipoprocesso">{{ trans('cruds.tipoProcesso.fields.tipoprocesso') }}</label>
                <input class="form-control {{ $errors->has('tipoprocesso') ? 'is-invalid' : '' }}" type="text" name="tipoprocesso" id="tipoprocesso" value="{{ old('tipoprocesso', $tipoProcesso->tipoprocesso) }}" required>
                @if($errors->has('tipoprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoProcesso.fields.tipoprocesso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricaotipoprocesso">{{ trans('cruds.tipoProcesso.fields.descricaotipoprocesso') }}</label>
                <input class="form-control {{ $errors->has('descricaotipoprocesso') ? 'is-invalid' : '' }}" type="text" name="descricaotipoprocesso" id="descricaotipoprocesso" value="{{ old('descricaotipoprocesso', $tipoProcesso->descricaotipoprocesso) }}">
                @if($errors->has('descricaotipoprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricaotipoprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoProcesso.fields.descricaotipoprocesso_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection