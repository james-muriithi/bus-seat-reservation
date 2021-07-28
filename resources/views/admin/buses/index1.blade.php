@extends('layouts.admin')
@section('content')
@can('bus_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.buses.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Bus">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bus_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.buses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.buses.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'bus_name', name: 'bus_name' },
{ data: 'bus_reg_no', name: 'bus_reg_no' },
{ data: 'bus_type_bus_type', name: 'bus_type.bus_type' },
{ data: 'max_seats', name: 'max_seats' },
{ data: 'amenities', name: 'amenities.name' },
{ data: 'status', name: 'status' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'images', name: 'images', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Bus').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection