@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.atividade.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.atividades.update", [$atividade->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="numeroprocesso_id">{{ trans('cruds.atividade.fields.numeroprocesso') }}</label>
                <select class="form-control select2 {{ $errors->has('numeroprocesso') ? 'is-invalid' : '' }}" name="numeroprocesso_id" id="numeroprocesso_id" required>
                    @foreach($numeroprocessos as $id => $numeroprocesso)
                        <option value="{{ $id }}" {{ (old('numeroprocesso_id') ? old('numeroprocesso_id') : $atividade->numeroprocesso->id ?? '') == $id ? 'selected' : '' }}>{{ $numeroprocesso }}</option>
                    @endforeach
                </select>
                @if($errors->has('numeroprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numeroprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.numeroprocesso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vista_num_processo">{{ trans('cruds.atividade.fields.vista_num_processo') }}</label>
                <input class="form-control {{ $errors->has('vista_num_processo') ? 'is-invalid' : '' }}" type="text" name="vista_num_processo" id="vista_num_processo" value="{{ old('vista_num_processo', $atividade->vista_num_processo) }}">
                @if($errors->has('vista_num_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vista_num_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.vista_num_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tipo_de_processo_id">{{ trans('cruds.atividade.fields.tipo_de_processo') }}</label>
                <select class="form-control select2 {{ $errors->has('tipo_de_processo') ? 'is-invalid' : '' }}" name="tipo_de_processo_id" id="tipo_de_processo_id" required>
                    @foreach($tipo_de_processos as $id => $tipo_de_processo)
                        <option value="{{ $id }}" {{ (old('tipo_de_processo_id') ? old('tipo_de_processo_id') : $atividade->tipo_de_processo->id ?? '') == $id ? 'selected' : '' }}>{{ $tipo_de_processo }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_de_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_de_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.tipo_de_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relatorio_da_atividade">{{ trans('cruds.atividade.fields.relatorio_da_atividade') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('relatorio_da_atividade') ? 'is-invalid' : '' }}" name="relatorio_da_atividade" id="relatorio_da_atividade">{!! old('relatorio_da_atividade', $atividade->relatorio_da_atividade) !!}</textarea>
                @if($errors->has('relatorio_da_atividade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relatorio_da_atividade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.relatorio_da_atividade_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="equipe_responsavels">{{ trans('cruds.atividade.fields.equipe_responsavel') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('equipe_responsavels') ? 'is-invalid' : '' }}" name="equipe_responsavels[]" id="equipe_responsavels" multiple required>
                    @foreach($equipe_responsavels as $id => $equipe_responsavel)
                        <option value="{{ $id }}" {{ (in_array($id, old('equipe_responsavels', [])) || $atividade->equipe_responsavels->contains($id)) ? 'selected' : '' }}>{{ $equipe_responsavel }}</option>
                    @endforeach
                </select>
                @if($errors->has('equipe_responsavels'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipe_responsavels') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.equipe_responsavel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.atividade.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $atividade->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_atividade">{{ trans('cruds.atividade.fields.data_atividade') }}</label>
                <input class="form-control date {{ $errors->has('data_atividade') ? 'is-invalid' : '' }}" type="text" name="data_atividade" id="data_atividade" value="{{ old('data_atividade', $atividade->data_atividade) }}" required>
                @if($errors->has('data_atividade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_atividade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atividade.fields.data_atividade_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/atividades/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $atividade->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection