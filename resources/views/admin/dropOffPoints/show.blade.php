@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dropOffPoint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drop-off-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.id') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.drop_off_point') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->drop_off_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.drop_time') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->drop_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.landmark') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->landmark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.address') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dropOffPoint.fields.route') }}
                        </th>
                        <td>
                            {{ $dropOffPoint->route->board_point ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drop-off-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection