@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tipoEstabelecimento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipo-estabelecimentos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="categoriaestabelecimento">{{ trans('cruds.tipoEstabelecimento.fields.categoriaestabelecimento') }}</label>
                <input class="form-control {{ $errors->has('categoriaestabelecimento') ? 'is-invalid' : '' }}" type="text" name="categoriaestabelecimento" id="categoriaestabelecimento" value="{{ old('categoriaestabelecimento', '') }}" required>
                @if($errors->has('categoriaestabelecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categoriaestabelecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoEstabelecimento.fields.categoriaestabelecimento_helper') }}</span>
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