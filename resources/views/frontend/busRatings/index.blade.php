@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bus_rating_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bus-ratings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.busRating.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.busRating.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BusRating">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.busRating.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.busRating.fields.bus_quality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.busRating.fields.punctuality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.busRating.fields.staff_behaviour') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.busRating.fields.comment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($busRatings as $key => $busRating)
                                    <tr data-entry-id="{{ $busRating->id }}">
                                        <td>
                                            {{ $busRating->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $busRating->bus_quality ?? '' }}
                                        </td>
                                        <td>
                                            {{ $busRating->punctuality ?? '' }}
                                        </td>
                                        <td>
                                            {{ $busRating->staff_behaviour ?? '' }}
                                        </td>
                                        <td>
                                            {{ $busRating->comment ?? '' }}
                                        </td>
                                        <td>
                                            @can('bus_rating_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bus-ratings.show', $busRating->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bus_rating_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bus-ratings.edit', $busRating->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bus_rating_delete')
                                                <form action="{{ route('frontend.bus-ratings.destroy', $busRating->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bus_rating_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bus-ratings.massDestroy') }}",
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
  let table = $('.datatable-BusRating:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection