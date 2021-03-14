@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.departamento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.departamentos.update", [$departamento->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="departamento">{{ trans('cruds.departamento.fields.departamento') }}</label>
                <input class="form-control {{ $errors->has('departamento') ? 'is-invalid' : '' }}" type="text" name="departamento" id="departamento" value="{{ old('departamento', $departamento->departamento) }}" required>
                @if($errors->has('departamento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departamento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.departamento.fields.departamento_helper') }}</span>
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