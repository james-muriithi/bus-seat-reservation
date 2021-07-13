@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bus_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.buses.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bus.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bus.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bus">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bus.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.bus_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.bus_reg_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.bus_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.max_seats') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.amenities') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.created_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bus.fields.images') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buses as $key => $bus)
                                    <tr data-entry-id="{{ $bus->id }}">
                                        <td>
                                            {{ $bus->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bus->bus_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bus->bus_reg_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bus->bus_type->bus_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bus->max_seats ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($bus->amenities as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bus->status ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bus->status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $bus->created_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($bus->images as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('bus_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.buses.show', $bus->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bus_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.buses.edit', $bus->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bus_delete')
                                                <form action="{{ route('frontend.buses.destroy', $bus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bus_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.buses.massDestroy') }}",
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
  let table = $('.datatable-Bus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection