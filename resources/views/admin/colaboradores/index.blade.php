@extends('layouts.admin')
@section('content')
@can('colaboradore_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.colaboradores.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.colaboradore.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.colaboradore.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Colaboradore">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.colaboradore.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.colaboradore.fields.nome') }}
                        </th>
                        <th>
                            {{ trans('cruds.colaboradore.fields.cpf') }}
                        </th>
                        <th>
                            {{ trans('cruds.colaboradore.fields.genero') }}
                        </th>
                        <th>
                            {{ trans('cruds.colaboradore.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colaboradores as $key => $colaboradore)
                        <tr data-entry-id="{{ $colaboradore->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $colaboradore->id ?? '' }}
                            </td>
                            <td>
                                {{ $colaboradore->nome ?? '' }}
                            </td>
                            <td>
                                {{ $colaboradore->cpf ?? '' }}
                            </td>
                            <td>
                                {{ $colaboradore->genero->genero ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Colaboradore::STATUS_SELECT[$colaboradore->status] ?? '' }}
                            </td>
                            <td>
                                @can('colaboradore_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.colaboradores.show', $colaboradore->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('colaboradore_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.colaboradores.edit', $colaboradore->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('colaboradore_delete')
                                    <form action="{{ route('admin.colaboradores.destroy', $colaboradore->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('colaboradore_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.colaboradores.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Colaboradore:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection