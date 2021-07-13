@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.pickupPoint.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pickup-points.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.pickup_point') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->pickup_point }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.pickup_time') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->pickup_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.status') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $pickupPoint->status ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.route') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->route->board_point ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.landmark') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->landmark }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pickupPoint.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $pickupPoint->address }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pickup-points.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection