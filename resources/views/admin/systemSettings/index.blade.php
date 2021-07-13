@extends('layouts.admin')
@section('content')
@can('system_setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.system-settings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.systemSetting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.systemSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SystemSetting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.default_currency') }}
                        </th>
                        <th>
                            {{ trans('cruds.currency.fields.currency_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.company_logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.smtp_username') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.smtp_host') }}
                        </th>
                        <th>
                            {{ trans('cruds.systemSetting.fields.smtp_password') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($systemSettings as $key => $systemSetting)
                        <tr data-entry-id="{{ $systemSetting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $systemSetting->id ?? '' }}
                            </td>
                            <td>
                                {{ $systemSetting->default_currency->currency_name ?? '' }}
                            </td>
                            <td>
                                {{ $systemSetting->default_currency->currency_name ?? '' }}
                            </td>
                            <td>
                                {{ $systemSetting->company_name ?? '' }}
                            </td>
                            <td>
                                @if($systemSetting->company_logo)
                                    <a href="{{ $systemSetting->company_logo->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $systemSetting->smtp_username ?? '' }}
                            </td>
                            <td>
                                {{ $systemSetting->smtp_host ?? '' }}
                            </td>
                            <td>
                                {{ $systemSetting->smtp_password ?? '' }}
                            </td>
                            <td>
                                @can('system_setting_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.system-settings.show', $systemSetting->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('system_setting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.system-settings.edit', $systemSetting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('system_setting_delete')
                                    <form action="{{ route('admin.system-settings.destroy', $systemSetting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('system_setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.system-settings.massDestroy') }}",
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
  let table = $('.datatable-SystemSetting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection