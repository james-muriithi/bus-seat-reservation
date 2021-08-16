@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.id') }}
                        </th>
                        <td>
                            {{ $trip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.trip') }}
                        </th>
                        <td>
                            {{ $trip->trip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.route') }}
                        </th>
                        <td>
                            {{ $trip->route->board_point ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.travel_date') }}
                        </th>
                        <td>
                            {{ $trip->travel_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.status') }}
                        </th>
                        <td>
                            {{ $trip->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.created_by') }}
                        </th>
                        <td>
                            {{ $trip->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection