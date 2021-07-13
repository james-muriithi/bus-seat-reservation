@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('pickup_point_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.pickup-points.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.pickupPoint.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.pickupPoint.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PickupPoint">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.pickup_point') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.pickup_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.route') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.landmark') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.address') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pickupPoints as $key => $pickupPoint)
                                    <tr data-entry-id="{{ $pickupPoint->id }}">
                                        <td>
                                            {{ $pickupPoint->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pickupPoint->pickup_point ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pickupPoint->pickup_time ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $pickupPoint->status ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $pickupPoint->status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $pickupPoint->route->board_point ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pickupPoint->landmark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pickupPoint->address ?? '' }}
                                        </td>
                                        <td>
                                            @can('pickup_point_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.pickup-points.show', $pickupPoint->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('pickup_point_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.pickup-points.edit', $pickupPoint->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('pickup_point_delete')
                                                <form action="{{ route('frontend.pickup-points.destroy', $pickupPoint->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pickup_point_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.pickup-points.massDestroy') }}",
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
  let table = $('.datatable-PickupPoint:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection