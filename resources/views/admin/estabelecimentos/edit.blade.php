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
                <label class="required" for="nomefantasia">{{ trans('cruds.estabelecimento.fields.nomefantasia') }}</label>
                <input class="form-control {{ $errors->has('nomefantasia') ? 'is-invalid' : '' }}" type="text" name="nomefantasia" id="nomefantasia" value="{{ old('nomefantasia', $estabelecimento->nomefantasia) }}" required>
                @if($errors->has('nomefantasia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nomefantasia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.nomefantasia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="natureza_do_estabelecimento">{{ trans('cruds.estabelecimento.fields.natureza_do_estabelecimento') }}</label>
                <input class="form-control {{ $errors->has('natureza_do_estabelecimento') ? 'is-invalid' : '' }}" type="text" name="natureza_do_estabelecimento" id="natureza_do_estabelecimento" value="{{ old('natureza_do_estabelecimento', $estabelecimento->natureza_do_estabelecimento) }}" required>
                @if($errors->has('natureza_do_estabelecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('natureza_do_estabelecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.natureza_do_estabelecimento_helper') }}</span>
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
                <label class="required" for="atividade_principal">{{ trans('cruds.estabelecimento.fields.atividade_principal') }}</label>
                <input class="form-control {{ $errors->has('atividade_principal') ? 'is-invalid' : '' }}" type="text" name="atividade_principal" id="atividade_principal" value="{{ old('atividade_principal', $estabelecimento->atividade_principal) }}" required>
                @if($errors->has('atividade_principal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('atividade_principal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.atividade_principal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="atividade_secundaria">{{ trans('cruds.estabelecimento.fields.atividade_secundaria') }}</label>
                <textarea class="form-control {{ $errors->has('atividade_secundaria') ? 'is-invalid' : '' }}" name="atividade_secundaria" id="atividade_secundaria">{{ old('atividade_secundaria', $estabelecimento->atividade_secundaria) }}</textarea>
                @if($errors->has('atividade_secundaria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('atividade_secundaria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.atividade_secundaria_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="logradouro">{{ trans('cruds.estabelecimento.fields.logradouro') }}</label>
                <input class="form-control {{ $errors->has('logradouro') ? 'is-invalid' : '' }}" type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $estabelecimento->logradouro) }}" required>
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
                <label for="ponto_de_referencia">{{ trans('cruds.estabelecimento.fields.ponto_de_referencia') }}</label>
                <input class="form-control {{ $errors->has('ponto_de_referencia') ? 'is-invalid' : '' }}" type="text" name="ponto_de_referencia" id="ponto_de_referencia" value="{{ old('ponto_de_referencia', $estabelecimento->ponto_de_referencia) }}">
                @if($errors->has('ponto_de_referencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ponto_de_referencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.ponto_de_referencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bairro_id">{{ trans('cruds.estabelecimento.fields.bairro') }}</label>
                <select class="form-control select2 {{ $errors->has('bairro') ? 'is-invalid' : '' }}" name="bairro_id" id="bairro_id" required>
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
                <label class="required" for="municipio">{{ trans('cruds.estabelecimento.fields.municipio') }}</label>
                <input class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" type="text" name="municipio" id="municipio" value="{{ old('municipio', $estabelecimento->municipio) }}" required>
                @if($errors->has('municipio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('municipio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.municipio_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="uf">{{ trans('cruds.estabelecimento.fields.uf') }}</label>
                <input class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}" type="text" name="uf" id="uf" value="{{ old('uf', $estabelecimento->uf) }}" required>
                @if($errors->has('uf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.uf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsavel_tecnico">{{ trans('cruds.estabelecimento.fields.responsavel_tecnico') }}</label>
                <input class="form-control {{ $errors->has('responsavel_tecnico') ? 'is-invalid' : '' }}" type="text" name="responsavel_tecnico" id="responsavel_tecnico" value="{{ old('responsavel_tecnico', $estabelecimento->responsavel_tecnico) }}">
                @if($errors->has('responsavel_tecnico'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsavel_tecnico') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.responsavel_tecnico_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cpf">{{ trans('cruds.estabelecimento.fields.cpf') }}</label>
                <input class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text" name="cpf" id="cpf" value="{{ old('cpf', $estabelecimento->cpf) }}">
                @if($errors->has('cpf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cpf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato">{{ trans('cruds.estabelecimento.fields.contato') }}</label>
                <input class="form-control {{ $errors->has('contato') ? 'is-invalid' : '' }}" type="text" name="contato" id="contato" value="{{ old('contato', $estabelecimento->contato) }}">
                @if($errors->has('contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estabelecimento.fields.contato_helper') }}</span>
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
                <label class="required" for="situacao">{{ trans('cruds.estabelecimento.fields.situacao') }}</label>
                <input class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" type="text" name="situacao" id="situacao" value="{{ old('situacao', $estabelecimento->situacao) }}" required>
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