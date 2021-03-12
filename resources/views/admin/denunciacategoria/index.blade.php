@extends('layouts.admin')
@section('content')
@can('denunciacategorium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.denunciacategoria.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.denunciacategorium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.denunciacategorium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Denunciacategorium">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.denunciacategorium.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($denunciacategoria as $key => $denunciacategorium)
                        <tr data-entry-id="{{ $denunciacategorium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $denunciacategorium->id ?? '' }}
                            </td>
                            <td>
                                {{ $denunciacategorium->name ?? '' }}
                            </td>
                            <td>
                                {{ $denunciacategorium->description ?? '' }}
                            </td>
                            <td>
                                @can('denunciacategorium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.denunciacategoria.show', $denunciacategorium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('denunciacategorium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.denunciacategoria.edit', $denunciacategorium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('denunciacategorium_delete')
                                    <form action="{{ route('admin.denunciacategoria.destroy', $denunciacategorium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('denunciacategorium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.denunciacategoria.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-Denunciacategorium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection