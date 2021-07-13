@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('passenger_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.passengers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.passenger.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.passenger.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Passenger">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.passenger.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.age') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.gender') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.passenger.fields.avatar') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passengers as $key => $passenger)
                                    <tr data-entry-id="{{ $passenger->id }}">
                                        <td>
                                            {{ $passenger->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $passenger->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $passenger->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $passenger->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $passenger->age ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Passenger::GENDER_RADIO[$passenger->gender] ?? '' }}
                                        </td>
                                        <td>
                                            @if($passenger->avatar)
                                                <a href="{{ $passenger->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $passenger->avatar->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('passenger_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.passengers.show', $passenger->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('passenger_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.passengers.edit', $passenger->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('passenger_delete')
                                                <form action="{{ route('frontend.passengers.destroy', $passenger->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('passenger_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.passengers.massDestroy') }}",
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
  let table = $('.datatable-Passenger:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection