@extends('layouts.admin')
@section('content')
@can('reg_denuncium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reg-denuncia.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.regDenuncium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.regDenuncium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RegDenuncium">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.data_denuncia') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.denunciante') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.contato') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.origem') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.categoria') }}
                        </th>
                        <th>
                            {{ trans('cruds.regDenuncium.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regDenuncia as $key => $regDenuncium)
                        <tr data-entry-id="{{ $regDenuncium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $regDenuncium->id ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->data_denuncia ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->denunciante ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->contato ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->origem->tag ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->categoria->categoria ?? '' }}
                            </td>
                            <td>
                                {{ $regDenuncium->status->status ?? '' }}
                            </td>
                            <td>
                                @can('reg_denuncium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.reg-denuncia.show', $regDenuncium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('reg_denuncium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.reg-denuncia.edit', $regDenuncium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('reg_denuncium_delete')
                                    <form action="{{ route('admin.reg-denuncia.destroy', $regDenuncium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('reg_denuncium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reg-denuncia.massDestroy') }}",
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
    pageLength: 50,
  });
  let table = $('.datatable-RegDenuncium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection