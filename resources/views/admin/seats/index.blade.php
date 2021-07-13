@extends('layouts.admin')
@section('content')
@can('seat_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.seats.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.seat.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.seat.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Seat">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.bus') }}
                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.row') }}
                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.column') }}
                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.seat.fields.details') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seats as $key => $seat)
                        <tr data-entry-id="{{ $seat->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $seat->id ?? '' }}
                            </td>
                            <td>
                                {{ $seat->bus->bus_name ?? '' }}
                            </td>
                            <td>
                                {{ $seat->row ?? '' }}
                            </td>
                            <td>
                                {{ $seat->column ?? '' }}
                            </td>
                            <td>
                                {{ $seat->name ?? '' }}
                            </td>
                            <td>
                                {{ $seat->details ?? '' }}
                            </td>
                            <td>
                                @can('seat_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.seats.show', $seat->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('seat_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.seats.edit', $seat->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('seat_delete')
                                    <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('seat_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.seats.massDestroy') }}",
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
  let table = $('.datatable-Seat:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection