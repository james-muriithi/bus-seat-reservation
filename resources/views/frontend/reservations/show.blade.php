@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.reservation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reservations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $reservation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.passenger') }}
                                    </th>
                                    <td>
                                        {{ $reservation->passenger->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.route') }}
                                    </th>
                                    <td>
                                        {{ $reservation->route->board_point ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.pickup_point') }}
                                    </th>
                                    <td>
                                        {{ $reservation->pickup_point->pickup_point ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.reservation_date') }}
                                    </th>
                                    <td>
                                        {{ $reservation->reservation_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.seat') }}
                                    </th>
                                    <td>
                                        @foreach($reservation->seats as $key => $seat)
                                            <span class="label label-info">{{ $seat->row }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reservations.index') }}">
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