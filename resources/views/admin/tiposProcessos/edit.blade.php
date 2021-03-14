@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tiposProcesso.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipos-processos.update", [$tiposProcesso->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tipoprocesso">{{ trans('cruds.tiposProcesso.fields.tipoprocesso') }}</label>
                <input class="form-control {{ $errors->has('tipoprocesso') ? 'is-invalid' : '' }}" type="text" name="tipoprocesso" id="tipoprocesso" value="{{ old('tipoprocesso', $tiposProcesso->tipoprocesso) }}" required>
                @if($errors->has('tipoprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tiposProcesso.fields.tipoprocesso_helper') }}</span>
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