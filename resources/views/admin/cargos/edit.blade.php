@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cargo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cargos.update", [$cargo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="gargo">{{ trans('cruds.cargo.fields.gargo') }}</label>
                <input class="form-control {{ $errors->has('gargo') ? 'is-invalid' : '' }}" type="text" name="gargo" id="gargo" value="{{ old('gargo', $cargo->gargo) }}" required>
                @if($errors->has('gargo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gargo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cargo.fields.gargo_helper') }}</span>
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