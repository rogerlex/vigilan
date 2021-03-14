@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.visitum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.visita.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.visitum.fields.motivo') }}</label>
                <select class="form-control {{ $errors->has('motivo') ? 'is-invalid' : '' }}" name="motivo" id="motivo" required>
                    <option value disabled {{ old('motivo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Visitum::MOTIVO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('motivo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('motivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.motivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="estabelecimentos">{{ trans('cruds.visitum.fields.estabelecimento') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('estabelecimentos') ? 'is-invalid' : '' }}" name="estabelecimentos[]" id="estabelecimentos" multiple required>
                    @foreach($estabelecimentos as $id => $estabelecimento)
                        <option value="{{ $id }}" {{ in_array($id, old('estabelecimentos', [])) ? 'selected' : '' }}>{{ $estabelecimento }}</option>
                    @endforeach
                </select>
                @if($errors->has('estabelecimentos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estabelecimentos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.estabelecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dataagendamento">{{ trans('cruds.visitum.fields.dataagendamento') }}</label>
                <input class="form-control date {{ $errors->has('dataagendamento') ? 'is-invalid' : '' }}" type="text" name="dataagendamento" id="dataagendamento" value="{{ old('dataagendamento') }}" required>
                @if($errors->has('dataagendamento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dataagendamento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.dataagendamento_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="equipes">{{ trans('cruds.visitum.fields.equipe') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('equipes') ? 'is-invalid' : '' }}" name="equipes[]" id="equipes" multiple required>
                    @foreach($equipes as $id => $equipe)
                        <option value="{{ $id }}" {{ in_array($id, old('equipes', [])) ? 'selected' : '' }}>{{ $equipe }}</option>
                    @endforeach
                </select>
                @if($errors->has('equipes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.equipe_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relatorio_observado">{{ trans('cruds.visitum.fields.relatorio_observado') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('relatorio_observado') ? 'is-invalid' : '' }}" name="relatorio_observado" id="relatorio_observado">{!! old('relatorio_observado') !!}</textarea>
                @if($errors->has('relatorio_observado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relatorio_observado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.relatorio_observado_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_visita_id">{{ trans('cruds.visitum.fields.status_visita') }}</label>
                <select class="form-control select2 {{ $errors->has('status_visita') ? 'is-invalid' : '' }}" name="status_visita_id" id="status_visita_id" required>
                    @foreach($status_visitas as $id => $status_visita)
                        <option value="{{ $id }}" {{ old('status_visita_id') == $id ? 'selected' : '' }}>{{ $status_visita }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_visita'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_visita') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.visitum.fields.status_visita_helper') }}</span>
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
                xhr.open('POST', '/admin/visita/ckmedia', true);
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
                data.append('crud_id', '{{ $visitum->id ?? 0 }}');
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