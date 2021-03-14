@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.origen.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.origens.update", [$origen->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="origem">{{ trans('cruds.origen.fields.origem') }}</label>
                <input class="form-control {{ $errors->has('origem') ? 'is-invalid' : '' }}" type="text" name="origem" id="origem" value="{{ old('origem', $origen->origem) }}" required>
                @if($errors->has('origem'))
                    <div class="invalid-feedback">
                        {{ $errors->first('origem') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.origen.fields.origem_helper') }}</span>
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