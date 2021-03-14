@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.formacao.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.formacaos.update", [$formacao->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="formacao">{{ trans('cruds.formacao.fields.formacao') }}</label>
                <input class="form-control {{ $errors->has('formacao') ? 'is-invalid' : '' }}" type="text" name="formacao" id="formacao" value="{{ old('formacao', $formacao->formacao) }}" required>
                @if($errors->has('formacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formacao.fields.formacao_helper') }}</span>
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