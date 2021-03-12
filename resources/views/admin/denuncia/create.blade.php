@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.denuncium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.denuncia.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="data_denuncia">{{ trans('cruds.denuncium.fields.data_denuncia') }}</label>
                <input class="form-control date {{ $errors->has('data_denuncia') ? 'is-invalid' : '' }}" type="text" name="data_denuncia" id="data_denuncia" value="{{ old('data_denuncia') }}" required>
                @if($errors->has('data_denuncia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_denuncia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.data_denuncia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="denunciante">{{ trans('cruds.denuncium.fields.denunciante') }}</label>
                <input class="form-control {{ $errors->has('denunciante') ? 'is-invalid' : '' }}" type="text" name="denunciante" id="denunciante" value="{{ old('denunciante', '') }}">
                @if($errors->has('denunciante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('denunciante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.denunciante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contato_denunciante">{{ trans('cruds.denuncium.fields.contato_denunciante') }}</label>
                <input class="form-control {{ $errors->has('contato_denunciante') ? 'is-invalid' : '' }}" type="text" name="contato_denunciante" id="contato_denunciante" value="{{ old('contato_denunciante', '') }}">
                @if($errors->has('contato_denunciante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contato_denunciante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.contato_denunciante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.denuncium.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="categories">{{ trans('cruds.denuncium.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tags">{{ trans('cruds.denuncium.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple required>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.denuncium.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tratativa">{{ trans('cruds.denuncium.fields.tratativa') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('tratativa') ? 'is-invalid' : '' }}" name="tratativa" id="tratativa">{!! old('tratativa') !!}</textarea>
                @if($errors->has('tratativa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tratativa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.tratativa_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.denuncium.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Denuncium::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_conclusao">{{ trans('cruds.denuncium.fields.data_conclusao') }}</label>
                <input class="form-control date {{ $errors->has('data_conclusao') ? 'is-invalid' : '' }}" type="text" name="data_conclusao" id="data_conclusao" value="{{ old('data_conclusao') }}">
                @if($errors->has('data_conclusao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_conclusao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.denuncium.fields.data_conclusao_helper') }}</span>
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
                xhr.open('POST', '/admin/denuncia/ckmedia', true);
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
                data.append('crud_id', '{{ $denuncium->id ?? 0 }}');
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.denuncia.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($denuncium) && $denuncium->photo)
      var files = {!! json_encode($denuncium->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
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