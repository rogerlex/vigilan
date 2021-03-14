@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.regDenuncium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reg-denuncia.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="data_denuncia">{{ trans('cruds.regDenuncium.fields.data_denuncia') }}</label>
                <input class="form-control date {{ $errors->has('data_denuncia') ? 'is-invalid' : '' }}" type="text" name="data_denuncia" id="data_denuncia" value="{{ old('data_denuncia') }}" required>
                @if($errors->has('data_denuncia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_denuncia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.data_denuncia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="denunciante">{{ trans('cruds.regDenuncium.fields.denunciante') }}</label>
                <input class="form-control {{ $errors->has('denunciante') ? 'is-invalid' : '' }}" type="text" name="denunciante" id="denunciante" value="{{ old('denunciante', '') }}">
                @if($errors->has('denunciante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('denunciante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.denunciante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato">{{ trans('cruds.regDenuncium.fields.contato') }}</label>
                <input class="form-control {{ $errors->has('contato') ? 'is-invalid' : '' }}" type="text" name="contato" id="contato" value="{{ old('contato', '') }}">
                @if($errors->has('contato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.contato_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.regDenuncium.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao') !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="origem_id">{{ trans('cruds.regDenuncium.fields.origem') }}</label>
                <select class="form-control select2 {{ $errors->has('origem') ? 'is-invalid' : '' }}" name="origem_id" id="origem_id" required>
                    @foreach($origems as $id => $origem)
                        <option value="{{ $id }}" {{ old('origem_id') == $id ? 'selected' : '' }}>{{ $origem }}</option>
                    @endforeach
                </select>
                @if($errors->has('origem'))
                    <div class="invalid-feedback">
                        {{ $errors->first('origem') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.origem_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="categoria_id">{{ trans('cruds.regDenuncium.fields.categoria') }}</label>
                <select class="form-control select2 {{ $errors->has('categoria') ? 'is-invalid' : '' }}" name="categoria_id" id="categoria_id" required>
                    @foreach($categorias as $id => $categoria)
                        <option value="{{ $id }}" {{ old('categoria_id') == $id ? 'selected' : '' }}>{{ $categoria }}</option>
                    @endforeach
                </select>
                @if($errors->has('categoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categoria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.categoria_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imagens">{{ trans('cruds.regDenuncium.fields.imagens') }}</label>
                <div class="needsclick dropzone {{ $errors->has('imagens') ? 'is-invalid' : '' }}" id="imagens-dropzone">
                </div>
                @if($errors->has('imagens'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imagens') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.imagens_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anexo">{{ trans('cruds.regDenuncium.fields.anexo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('anexo') ? 'is-invalid' : '' }}" id="anexo-dropzone">
                </div>
                @if($errors->has('anexo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anexo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.anexo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.regDenuncium.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="feedback">{{ trans('cruds.regDenuncium.fields.feedback') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('feedback') ? 'is-invalid' : '' }}" name="feedback" id="feedback">{!! old('feedback') !!}</textarea>
                @if($errors->has('feedback'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feedback') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regDenuncium.fields.feedback_helper') }}</span>
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
                xhr.open('POST', '/admin/reg-denuncia/ckmedia', true);
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
                data.append('crud_id', '{{ $regDenuncium->id ?? 0 }}');
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
    Dropzone.options.imagensDropzone = {
    url: '{{ route('admin.reg-denuncia.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="imagens"]').remove()
      $('form').append('<input type="hidden" name="imagens" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="imagens"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($regDenuncium) && $regDenuncium->imagens)
      var file = {!! json_encode($regDenuncium->imagens) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="imagens" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    Dropzone.options.anexoDropzone = {
    url: '{{ route('admin.reg-denuncia.storeMedia') }}',
    maxFilesize: 4, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').find('input[name="anexo"]').remove()
      $('form').append('<input type="hidden" name="anexo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="anexo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($regDenuncium) && $regDenuncium->anexo)
      var file = {!! json_encode($regDenuncium->anexo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="anexo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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