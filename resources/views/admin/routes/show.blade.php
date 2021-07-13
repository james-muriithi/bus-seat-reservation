@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.route.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.routes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.id') }}
                        </th>
                        <td>
                            {{ $route->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.bus') }}
                        </th>
                        <td>
                            {{ $route->bus->bus_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.board_point') }}
                        </th>
                        <td>
                            {{ $route->board_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.board_time') }}
                        </th>
                        <td>
                            {{ $route->board_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.drop_point') }}
                        </th>
                        <td>
                            {{ $route->drop_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.drop_time') }}
                        </th>
                        <td>
                            {{ $route->drop_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.fare') }}
                        </th>
                        <td>
                            {{ $route->fare }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.route.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $route->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.routes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection