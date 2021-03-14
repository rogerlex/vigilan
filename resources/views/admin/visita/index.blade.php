@extends('layouts.admin')
@section('content')
@can('visitum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.visita.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.visitum.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.visitum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Visitum">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.motivo') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.estabelecimento') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.dataagendamento') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.equipe') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitum.fields.status_visita') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visita as $key => $visitum)
                        <tr data-entry-id="{{ $visitum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $visitum->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Visitum::MOTIVO_SELECT[$visitum->motivo] ?? '' }}
                            </td>
                            <td>
                                @foreach($visitum->estabelecimentos as $key => $item)
                                    <span class="badge badge-info">{{ $item->razaosocial }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $visitum->dataagendamento ?? '' }}
                            </td>
                            <td>
                                @foreach($visitum->equipes as $key => $item)
                                    <span class="badge badge-info">{{ $item->nome }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $visitum->status_visita->status ?? '' }}
                            </td>
                            <td>
                                @can('visitum_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.visita.show', $visitum->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('visitum_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.visita.edit', $visitum->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('visitum_delete')
                                    <form action="{{ route('admin.visita.destroy', $visitum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('visitum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.visita.massDestroy') }}",
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
  let table = $('.datatable-Visitum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection