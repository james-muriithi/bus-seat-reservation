@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.reservation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reservations.update", [$reservation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="passenger_id">{{ trans('cruds.reservation.fields.passenger') }}</label>
                <select class="form-control select2 {{ $errors->has('passenger') ? 'is-invalid' : '' }}" name="passenger_id" id="passenger_id" required>
                    @foreach($passengers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('passenger_id') ? old('passenger_id') : $reservation->passenger->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('passenger'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passenger') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.passenger_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_id">{{ trans('cruds.reservation.fields.route') }}</label>
                <select class="form-control select2 {{ $errors->has('route') ? 'is-invalid' : '' }}" name="route_id" id="route_id">
                    @foreach($routes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('route_id') ? old('route_id') : $reservation->route->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('route'))
                    <div class="invalid-feedback">
                        {{ $errors->first('route') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.route_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pickup_point_id">{{ trans('cruds.reservation.fields.pickup_point') }}</label>
                <select class="form-control select2 {{ $errors->has('pickup_point') ? 'is-invalid' : '' }}" name="pickup_point_id" id="pickup_point_id" required>
                    @foreach($pickup_points as $id => $entry)
                        <option value="{{ $id }}" {{ (old('pickup_point_id') ? old('pickup_point_id') : $reservation->pickup_point->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pickup_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.pickup_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reservation_date">{{ trans('cruds.reservation.fields.reservation_date') }}</label>
                <input class="form-control date {{ $errors->has('reservation_date') ? 'is-invalid' : '' }}" type="text" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date) }}" required>
                @if($errors->has('reservation_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reservation_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.reservation_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seats">{{ trans('cruds.reservation.fields.seat') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('seats') ? 'is-invalid' : '' }}" name="seats[]" id="seats" multiple required>
                    @foreach($seats as $id => $seat)
                        <option value="{{ $id }}" {{ (in_array($id, old('seats', [])) || $reservation->seats->contains($id)) ? 'selected' : '' }}>{{ $seat }}</option>
                    @endforeach
                </select>
                @if($errors->has('seats'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seats') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection