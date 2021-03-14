@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.colaboradore.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.colaboradores.update", [$colaboradore->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nome">{{ trans('cruds.colaboradore.fields.nome') }}</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome" id="nome" value="{{ old('nome', $colaboradore->nome) }}" required>
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.nome_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cpf">{{ trans('cruds.colaboradore.fields.cpf') }}</label>
                <input class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text" name="cpf" id="cpf" value="{{ old('cpf', $colaboradore->cpf) }}" required>
                @if($errors->has('cpf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cpf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="genero_id">{{ trans('cruds.colaboradore.fields.genero') }}</label>
                <select class="form-control select2 {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero_id" id="genero_id" required>
                    @foreach($generos as $id => $genero)
                        <option value="{{ $id }}" {{ (old('genero_id') ? old('genero_id') : $colaboradore->genero->id ?? '') == $id ? 'selected' : '' }}>{{ $genero }}</option>
                    @endforeach
                </select>
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.genero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telefone">{{ trans('cruds.colaboradore.fields.telefone') }}</label>
                <input class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}" type="text" name="telefone" id="telefone" value="{{ old('telefone', $colaboradore->telefone) }}">
                @if($errors->has('telefone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.telefone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.colaboradore.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $colaboradore->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="formacao_id">{{ trans('cruds.colaboradore.fields.formacao') }}</label>
                <select class="form-control select2 {{ $errors->has('formacao') ? 'is-invalid' : '' }}" name="formacao_id" id="formacao_id" required>
                    @foreach($formacaos as $id => $formacao)
                        <option value="{{ $id }}" {{ (old('formacao_id') ? old('formacao_id') : $colaboradore->formacao->id ?? '') == $id ? 'selected' : '' }}>{{ $formacao }}</option>
                    @endforeach
                </select>
                @if($errors->has('formacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.formacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cargo_id">{{ trans('cruds.colaboradore.fields.cargo') }}</label>
                <select class="form-control select2 {{ $errors->has('cargo') ? 'is-invalid' : '' }}" name="cargo_id" id="cargo_id" required>
                    @foreach($cargos as $id => $cargo)
                        <option value="{{ $id }}" {{ (old('cargo_id') ? old('cargo_id') : $colaboradore->cargo->id ?? '') == $id ? 'selected' : '' }}>{{ $cargo }}</option>
                    @endforeach
                </select>
                @if($errors->has('cargo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cargo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.cargo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.colaboradore.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Colaboradore::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $colaboradore->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departamentos">{{ trans('cruds.colaboradore.fields.departamento') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('departamentos') ? 'is-invalid' : '' }}" name="departamentos[]" id="departamentos" multiple>
                    @foreach($departamentos as $id => $departamento)
                        <option value="{{ $id }}" {{ (in_array($id, old('departamentos', [])) || $colaboradore->departamentos->contains($id)) ? 'selected' : '' }}>{{ $departamento }}</option>
                    @endforeach
                </select>
                @if($errors->has('departamentos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departamentos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colaboradore.fields.departamento_helper') }}</span>
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