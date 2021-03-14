@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.identidadegenero.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.identidadegeneros.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="genero">{{ trans('cruds.identidadegenero.fields.genero') }}</label>
                <input class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" type="text" name="genero" id="genero" value="{{ old('genero', '') }}" required>
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.identidadegenero.fields.genero_helper') }}</span>
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