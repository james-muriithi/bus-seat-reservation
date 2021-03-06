@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('drop_off_point_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.drop-off-points.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.dropOffPoint.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dropOffPoint.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-DropOffPoint">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.drop_off_point') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.drop_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.landmark') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dropOffPoint.fields.route') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dropOffPoints as $key => $dropOffPoint)
                                    <tr data-entry-id="{{ $dropOffPoint->id }}">
                                        <td>
                                            {{ $dropOffPoint->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dropOffPoint->drop_off_point ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dropOffPoint->drop_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dropOffPoint->landmark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dropOffPoint->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dropOffPoint->route->board_point ?? '' }}
                                        </td>
                                        <td>
                                            @can('drop_off_point_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.drop-off-points.show', $dropOffPoint->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('drop_off_point_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.drop-off-points.edit', $dropOffPoint->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('drop_off_point_delete')
                                                <form action="{{ route('frontend.drop-off-points.destroy', $dropOffPoint->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('drop_off_point_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.drop-off-points.massDestroy') }}",
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
  let table = $('.datatable-DropOffPoint:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection