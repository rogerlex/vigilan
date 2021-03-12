@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.estabelecimento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.estabelecimentos.update", [$estabelecimento->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="cnpj">{{ trans('cruds.estabelecimento.fields.cnpj') }}</label>
                <input class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}" type="text" name="cnpj" id="cnpj" value="{{ old('cnpj', $estabelecimento->cnpj) }}" required>
                @if($errors->has('cnpj'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cnpj') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.cnpj_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="razaosocial">{{ trans('cruds.estabelecimento.fields.razaosocial') }}</label>
                <input class="form-control {{ $errors->has('razaosocial') ? 'is-invalid' : '' }}" type="text" name="razaosocial" id="razaosocial" value="{{ old('razaosocial', $estabelecimento->razaosocial) }}" required>
                @if($errors->has('razaosocial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('razaosocial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.razaosocial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nomefantasia">{{ trans('cruds.estabelecimento.fields.nomefantasia') }}</label>
                <input class="form-control {{ $errors->has('nomefantasia') ? 'is-invalid' : '' }}" type="text" name="nomefantasia" id="nomefantasia" value="{{ old('nomefantasia', $estabelecimento->nomefantasia) }}">
                @if($errors->has('nomefantasia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nomefantasia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.nomefantasia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="natureza">{{ trans('cruds.estabelecimento.fields.natureza') }}</label>
                <input class="form-control {{ $errors->has('natureza') ? 'is-invalid' : '' }}" type="text" name="natureza" id="natureza" value="{{ old('natureza', $estabelecimento->natureza) }}">
                @if($errors->has('natureza'))
                    <div class="invalid-feedback">
                        {{ $errors->first('natureza') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.natureza_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tipo">{{ trans('cruds.estabelecimento.fields.tipo') }}</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', $estabelecimento->tipo) }}">
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area">{{ trans('cruds.estabelecimento.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="number" name="area" id="area" value="{{ old('area', $estabelecimento->area) }}" step="0.01">
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="atvprincipal">{{ trans('cruds.estabelecimento.fields.atvprincipal') }}</label>
                <input class="form-control {{ $errors->has('atvprincipal') ? 'is-invalid' : '' }}" type="text" name="atvprincipal" id="atvprincipal" value="{{ old('atvprincipal', $estabelecimento->atvprincipal) }}">
                @if($errors->has('atvprincipal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('atvprincipal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.atvprincipal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="atvsecundaria">{{ trans('cruds.estabelecimento.fields.atvsecundaria') }}</label>
                <input class="form-control {{ $errors->has('atvsecundaria') ? 'is-invalid' : '' }}" type="text" name="atvsecundaria" id="atvsecundaria" value="{{ old('atvsecundaria', $estabelecimento->atvsecundaria) }}">
                @if($errors->has('atvsecundaria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('atvsecundaria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.atvsecundaria_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logradouro">{{ trans('cruds.estabelecimento.fields.logradouro') }}</label>
                <input class="form-control {{ $errors->has('logradouro') ? 'is-invalid' : '' }}" type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $estabelecimento->logradouro) }}">
                @if($errors->has('logradouro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logradouro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.logradouro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numero">{{ trans('cruds.estabelecimento.fields.numero') }}</label>
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero" id="numero" value="{{ old('numero', $estabelecimento->numero) }}">
                @if($errors->has('numero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.numero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referencia">{{ trans('cruds.estabelecimento.fields.referencia') }}</label>
                <input class="form-control {{ $errors->has('referencia') ? 'is-invalid' : '' }}" type="text" name="referencia" id="referencia" value="{{ old('referencia', $estabelecimento->referencia) }}">
                @if($errors->has('referencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('referencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.referencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro_id">{{ trans('cruds.estabelecimento.fields.bairro') }}</label>
                <select class="form-control select2 {{ $errors->has('bairro') ? 'is-invalid' : '' }}" name="bairro_id" id="bairro_id">
                    @foreach($bairros as $id => $bairro)
                        <option value="{{ $id }}" {{ (old('bairro_id') ? old('bairro_id') : $estabelecimento->bairro->id ?? '') == $id ? 'selected' : '' }}>{{ $bairro }}</option>
                    @endforeach
                </select>
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="uf">{{ trans('cruds.estabelecimento.fields.uf') }}</label>
                <input class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}" type="text" name="uf" id="uf" value="{{ old('uf', $estabelecimento->uf) }}">
                @if($errors->has('uf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.uf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="municipio">{{ trans('cruds.estabelecimento.fields.municipio') }}</label>
                <input class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" type="text" name="municipio" id="municipio" value="{{ old('municipio', $estabelecimento->municipio) }}">
                @if($errors->has('municipio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('municipio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.municipio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsavel">{{ trans('cruds.estabelecimento.fields.responsavel') }}</label>
                <input class="form-control {{ $errors->has('responsavel') ? 'is-invalid' : '' }}" type="text" name="responsavel" id="responsavel" value="{{ old('responsavel', $estabelecimento->responsavel) }}">
                @if($errors->has('responsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foneresponsavel">{{ trans('cruds.estabelecimento.fields.foneresponsavel') }}</label>
                <input class="form-control {{ $errors->has('foneresponsavel') ? 'is-invalid' : '' }}" type="text" name="foneresponsavel" id="foneresponsavel" value="{{ old('foneresponsavel', $estabelecimento->foneresponsavel) }}">
                @if($errors->has('foneresponsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foneresponsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.foneresponsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cpfresponsavel">{{ trans('cruds.estabelecimento.fields.cpfresponsavel') }}</label>
                <input class="form-control {{ $errors->has('cpfresponsavel') ? 'is-invalid' : '' }}" type="text" name="cpfresponsavel" id="cpfresponsavel" value="{{ old('cpfresponsavel', $estabelecimento->cpfresponsavel) }}">
                @if($errors->has('cpfresponsavel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cpfresponsavel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.cpfresponsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wattsapp">{{ trans('cruds.estabelecimento.fields.wattsapp') }}</label>
                <input class="form-control {{ $errors->has('wattsapp') ? 'is-invalid' : '' }}" type="text" name="wattsapp" id="wattsapp" value="{{ old('wattsapp', $estabelecimento->wattsapp) }}">
                @if($errors->has('wattsapp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wattsapp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.wattsapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.estabelecimento.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $estabelecimento->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="situacao">{{ trans('cruds.estabelecimento.fields.situacao') }}</label>
                <input class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" type="text" name="situacao" id="situacao" value="{{ old('situacao', $estabelecimento->situacao) }}">
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.situacao_helper') }}</span>
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