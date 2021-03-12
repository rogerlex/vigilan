@extends('layouts.admin')
@section('content')
@can('processo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.processos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.processo.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.processo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Processo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.tipoprocesso') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.inicio') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.fim') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.solicitante') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.emailprocesso') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.tipoestabelecimento') }}
                        </th>
                        <th>
                            {{ trans('cruds.processo.fields.anexos') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processos as $key => $processo)
                        <tr data-entry-id="{{ $processo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $processo->id ?? '' }}
                            </td>
                            <td>
                                {{ $processo->tipoprocesso->tipoprocesso ?? '' }}
                            </td>
                            <td>
                                {{ $processo->inicio ?? '' }}
                            </td>
                            <td>
                                {{ $processo->fim ?? '' }}
                            </td>
                            <td>
                                {{ $processo->solicitante ?? '' }}
                            </td>
                            <td>
                                {{ $processo->emailprocesso ?? '' }}
                            </td>
                            <td>
                                {{ $processo->tipoestabelecimento->categoriaestabelecimento ?? '' }}
                            </td>
                            <td>
                                @foreach($processo->anexos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('processo_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.processos.show', $processo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('processo_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.processos.edit', $processo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('processo_delete')
                                    <form action="{{ route('admin.processos.destroy', $processo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('processo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.processos.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Processo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection