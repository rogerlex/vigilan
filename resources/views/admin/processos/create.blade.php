@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.processo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.processos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipoprocesso_id">{{ trans('cruds.processo.fields.tipoprocesso') }}</label>
                <select class="form-control select2 {{ $errors->has('tipoprocesso') ? 'is-invalid' : '' }}" name="tipoprocesso_id" id="tipoprocesso_id">
                    @foreach($tipoprocessos as $id => $tipoprocesso)
                        <option value="{{ $id }}" {{ old('tipoprocesso_id') == $id ? 'selected' : '' }}>{{ $tipoprocesso }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipoprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.tipoprocesso_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="inicio">{{ trans('cruds.processo.fields.inicio') }}</label>
                <input class="form-control date {{ $errors->has('inicio') ? 'is-invalid' : '' }}" type="text" name="inicio" id="inicio" value="{{ old('inicio') }}" required>
                @if($errors->has('inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.inicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fim">{{ trans('cruds.processo.fields.fim') }}</label>
                <input class="form-control date {{ $errors->has('fim') ? 'is-invalid' : '' }}" type="text" name="fim" id="fim" value="{{ old('fim') }}">
                @if($errors->has('fim'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fim') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.fim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="solicitante">{{ trans('cruds.processo.fields.solicitante') }}</label>
                <input class="form-control {{ $errors->has('solicitante') ? 'is-invalid' : '' }}" type="text" name="solicitante" id="solicitante" value="{{ old('solicitante', '') }}" required>
                @if($errors->has('solicitante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solicitante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.solicitante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="emailprocesso">{{ trans('cruds.processo.fields.emailprocesso') }}</label>
                <input class="form-control {{ $errors->has('emailprocesso') ? 'is-invalid' : '' }}" type="email" name="emailprocesso" id="emailprocesso" value="{{ old('emailprocesso') }}">
                @if($errors->has('emailprocesso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emailprocesso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.emailprocesso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.processo.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao') !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tipoestabelecimento_id">{{ trans('cruds.processo.fields.tipoestabelecimento') }}</label>
                <select class="form-control select2 {{ $errors->has('tipoestabelecimento') ? 'is-invalid' : '' }}" name="tipoestabelecimento_id" id="tipoestabelecimento_id" required>
                    @foreach($tipoestabelecimentos as $id => $tipoestabelecimento)
                        <option value="{{ $id }}" {{ old('tipoestabelecimento_id') == $id ? 'selected' : '' }}>{{ $tipoestabelecimento }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipoestabelecimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoestabelecimento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.tipoestabelecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anexos">{{ trans('cruds.processo.fields.anexos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('anexos') ? 'is-invalid' : '' }}" id="anexos-dropzone">
                </div>
                @if($errors->has('anexos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anexos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.anexos_helper') }}</span>
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
                xhr.open('POST', '/admin/processos/ckmedia', true);
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
                data.append('crud_id', '{{ $processo->id ?? 0 }}');
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

<script>
    var uploadedAnexosMap = {}
Dropzone.options.anexosDropzone = {
    url: '{{ route('admin.processos.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="anexos[]" value="' + response.name + '">')
      uploadedAnexosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAnexosMap[file.name]
      }
      $('form').find('input[name="anexos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($processo) && $processo->anexos)
      var files = {!! json_encode($processo->anexos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="anexos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection