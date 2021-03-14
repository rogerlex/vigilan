@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pendencium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pendencia.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="idestabelecimento_id">{{ trans('cruds.pendencium.fields.idestabelecimento') }}</label>
                <select class="form-control select2 {{ $errors->has('idestabelecimento') ? 'is-invalid' : '' }}" name="idestabelecimento_id" id="idestabelecimento_id" required>
                    @foreach($idestabelecimentos as $id => $idestabelecimento)
                        <option value="{{ $id }}" {{ old('idestabelecimento_id') == $id ? 'selected' : '' }}>{{ $idestabelecimento }}</option>
                    @endforeach
                </select>
                @if($errors->has('idestabelecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('idestabelecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pendencium.fields.idestabelecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pendencia">{{ trans('cruds.pendencium.fields.pendencia') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('pendencia') ? 'is-invalid' : '' }}" name="pendencia" id="pendencia">{!! old('pendencia') !!}</textarea>
                @if($errors->has('pendencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pendencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pendencium.fields.pendencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prazo">{{ trans('cruds.pendencium.fields.prazo') }}</label>
                <input class="form-control date {{ $errors->has('prazo') ? 'is-invalid' : '' }}" type="text" name="prazo" id="prazo" value="{{ old('prazo') }}" required>
                @if($errors->has('prazo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prazo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pendencium.fields.prazo_helper') }}</span>
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
                xhr.open('POST', '/admin/pendencia/ckmedia', true);
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
                data.append('crud_id', '{{ $pendencium->id ?? 0 }}');
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