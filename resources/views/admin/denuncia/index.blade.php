@extends('layouts.admin')
@section('content')
@can('denuncium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.denuncia.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.denuncium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.denuncium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Denuncium">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.data_denuncia') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.denunciante') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.contato_denunciante') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.tag') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.denuncium.fields.data_conclusao') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($denuncia as $key => $denuncium)
                        <tr data-entry-id="{{ $denuncium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $denuncium->id ?? '' }}
                            </td>
                            <td>
                                {{ $denuncium->data_denuncia ?? '' }}
                            </td>
                            <td>
                                {{ $denuncium->denunciante ?? '' }}
                            </td>
                            <td>
                                {{ $denuncium->contato_denunciante ?? '' }}
                            </td>
                            <td>
                                @foreach($denuncium->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($denuncium->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($denuncium->photo as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\Denuncium::STATUS_SELECT[$denuncium->status] ?? '' }}
                            </td>
                            <td>
                                {{ $denuncium->data_conclusao ?? '' }}
                            </td>
                            <td>
                                @can('denuncium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.denuncia.show', $denuncium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('denuncium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.denuncia.edit', $denuncium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('denuncium_delete')
                                    <form action="{{ route('admin.denuncia.destroy', $denuncium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('denuncium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.denuncia.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Denuncium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection