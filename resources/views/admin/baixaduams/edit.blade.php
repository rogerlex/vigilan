@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.baixaduam.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.baixaduams.update", [$baixaduam->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="processos">{{ trans('cruds.baixaduam.fields.processo') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('processos') ? 'is-invalid' : '' }}" name="processos[]" id="processos" multiple required>
                    @foreach($processos as $id => $processo)
                        <option value="{{ $id }}" {{ (in_array($id, old('processos', [])) || $baixaduam->processos->contains($id)) ? 'selected' : '' }}>{{ $processo }}</option>
                    @endforeach
                </select>
                @if($errors->has('processos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('processos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.processo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_duam">{{ trans('cruds.baixaduam.fields.id_duam') }}</label>
                <input class="form-control {{ $errors->has('id_duam') ? 'is-invalid' : '' }}" type="text" name="id_duam" id="id_duam" value="{{ old('id_duam', $baixaduam->id_duam) }}" required>
                @if($errors->has('id_duam'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_duam') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.id_duam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_emissao">{{ trans('cruds.baixaduam.fields.data_emissao') }}</label>
                <input class="form-control date {{ $errors->has('data_emissao') ? 'is-invalid' : '' }}" type="text" name="data_emissao" id="data_emissao" value="{{ old('data_emissao', $baixaduam->data_emissao) }}" required>
                @if($errors->has('data_emissao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_emissao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.data_emissao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_pagamento">{{ trans('cruds.baixaduam.fields.data_pagamento') }}</label>
                <input class="form-control date {{ $errors->has('data_pagamento') ? 'is-invalid' : '' }}" type="text" name="data_pagamento" id="data_pagamento" value="{{ old('data_pagamento', $baixaduam->data_pagamento) }}" required>
                @if($errors->has('data_pagamento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_pagamento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.data_pagamento_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="valorpago">{{ trans('cruds.baixaduam.fields.valorpago') }}</label>
                <input class="form-control {{ $errors->has('valorpago') ? 'is-invalid' : '' }}" type="number" name="valorpago" id="valorpago" value="{{ old('valorpago', $baixaduam->valorpago) }}" step="0.01" required>
                @if($errors->has('valorpago'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valorpago') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.valorpago_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comprovante">{{ trans('cruds.baixaduam.fields.comprovante') }}</label>
                <div class="needsclick dropzone {{ $errors->has('comprovante') ? 'is-invalid' : '' }}" id="comprovante-dropzone">
                </div>
                @if($errors->has('comprovante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comprovante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.baixaduam.fields.comprovante_helper') }}</span>
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
    Dropzone.options.comprovanteDropzone = {
    url: '{{ route('admin.baixaduams.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="comprovante"]').remove()
      $('form').append('<input type="hidden" name="comprovante" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="comprovante"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($baixaduam) && $baixaduam->comprovante)
      var file = {!! json_encode($baixaduam->comprovante) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="comprovante" value="' + file.file_name + '">')
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