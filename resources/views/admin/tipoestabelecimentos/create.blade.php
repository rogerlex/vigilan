@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tipoestabelecimento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipoestabelecimentos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tipoestabelecimento">{{ trans('cruds.tipoestabelecimento.fields.tipoestabelecimento') }}</label>
                <input class="form-control {{ $errors->has('tipoestabelecimento') ? 'is-invalid' : '' }}" type="text" name="tipoestabelecimento" id="tipoestabelecimento" value="{{ old('tipoestabelecimento', '') }}" required>
                @if($errors->has('tipoestabelecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoestabelecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoestabelecimento.fields.tipoestabelecimento_helper') }}</span>
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