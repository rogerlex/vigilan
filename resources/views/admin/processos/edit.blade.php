@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.processo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.processos.update", [$processo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="numero_do_processo">{{ trans('cruds.processo.fields.numero_do_processo') }}</label>
                <input class="form-control {{ $errors->has('numero_do_processo') ? 'is-invalid' : '' }}" type="text" name="numero_do_processo" id="numero_do_processo" value="{{ old('numero_do_processo', $processo->numero_do_processo) }}" required>
                @if($errors->has('numero_do_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_do_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.numero_do_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tipoprocesso_id">{{ trans('cruds.processo.fields.tipoprocesso') }}</label>
                <select class="form-control select2 {{ $errors->has('tipoprocesso') ? 'is-invalid' : '' }}" name="tipoprocesso_id" id="tipoprocesso_id" required>
                    @foreach($tipoprocessos as $id => $tipoprocesso)
                        <option value="{{ $id }}" {{ (old('tipoprocesso_id') ? old('tipoprocesso_id') : $processo->tipoprocesso->id ?? '') == $id ? 'selected' : '' }}>{{ $tipoprocesso }}</option>
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
                <label class="required" for="inicio_processo">{{ trans('cruds.processo.fields.inicio_processo') }}</label>
                <input class="form-control date {{ $errors->has('inicio_processo') ? 'is-invalid' : '' }}" type="text" name="inicio_processo" id="inicio_processo" value="{{ old('inicio_processo', $processo->inicio_processo) }}" required>
                @if($errors->has('inicio_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inicio_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.inicio_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="final_processo">{{ trans('cruds.processo.fields.final_processo') }}</label>
                <input class="form-control date {{ $errors->has('final_processo') ? 'is-invalid' : '' }}" type="text" name="final_processo" id="final_processo" value="{{ old('final_processo', $processo->final_processo) }}">
                @if($errors->has('final_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('final_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.final_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="solicitante">{{ trans('cruds.processo.fields.solicitante') }}</label>
                <input class="form-control {{ $errors->has('solicitante') ? 'is-invalid' : '' }}" type="text" name="solicitante" id="solicitante" value="{{ old('solicitante', $processo->solicitante) }}" required>
                @if($errors->has('solicitante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solicitante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.solicitante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.processo.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $processo->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.processo.fields.descricao') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao">{!! old('descricao', $processo->descricao) !!}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anexo_processo">{{ trans('cruds.processo.fields.anexo_processo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('anexo_processo') ? 'is-invalid' : '' }}" id="anexo_processo-dropzone">
                </div>
                @if($errors->has('anexo_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anexo_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.anexo_processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estabelecimentos">{{ trans('cruds.processo.fields.estabelecimento') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('estabelecimentos') ? 'is-invalid' : '' }}" name="estabelecimentos[]" id="estabelecimentos" multiple>
                    @foreach($estabelecimentos as $id => $estabelecimento)
                        <option value="{{ $id }}" {{ (in_array($id, old('estabelecimentos', [])) || $processo->estabelecimentos->contains($id)) ? 'selected' : '' }}>{{ $estabelecimento }}</option>
                    @endforeach
                </select>
                @if($errors->has('estabelecimentos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estabelecimentos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.estabelecimento_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_processo_id">{{ trans('cruds.processo.fields.status_processo') }}</label>
                <select class="form-control select2 {{ $errors->has('status_processo') ? 'is-invalid' : '' }}" name="status_processo_id" id="status_processo_id" required>
                    @foreach($status_processos as $id => $status_processo)
                        <option value="{{ $id }}" {{ (old('status_processo_id') ? old('status_processo_id') : $processo->status_processo->id ?? '') == $id ? 'selected' : '' }}>{{ $status_processo }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_processo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_processo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.processo.fields.status_processo_helper') }}</span>
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
    var uploadedAnexoProcessoMap = {}
Dropzone.options.anexoProcessoDropzone = {
    url: '{{ route('admin.processos.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="anexo_processo[]" value="' + response.name + '">')
      uploadedAnexoProcessoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAnexoProcessoMap[file.name]
      }
      $('form').find('input[name="anexo_processo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($processo) && $processo->anexo_processo)
          var files =
            {!! json_encode($processo->anexo_processo) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="anexo_processo[]" value="' + file.file_name + '">')
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