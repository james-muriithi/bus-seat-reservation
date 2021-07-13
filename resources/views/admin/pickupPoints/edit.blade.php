@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pickupPoint.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pickup-points.update", [$pickupPoint->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pickup_point">{{ trans('cruds.pickupPoint.fields.pickup_point') }}</label>
                <input class="form-control {{ $errors->has('pickup_point') ? 'is-invalid' : '' }}" type="text" name="pickup_point" id="pickup_point" value="{{ old('pickup_point', $pickupPoint->pickup_point) }}" required>
                @if($errors->has('pickup_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.pickup_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pickup_time">{{ trans('cruds.pickupPoint.fields.pickup_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('pickup_time') ? 'is-invalid' : '' }}" type="text" name="pickup_time" id="pickup_time" value="{{ old('pickup_time', $pickupPoint->pickup_time) }}" required>
                @if($errors->has('pickup_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.pickup_time_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $pickupPoint->status || old('status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.pickupPoint.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="route_id">{{ trans('cruds.pickupPoint.fields.route') }}</label>
                <select class="form-control select2 {{ $errors->has('route') ? 'is-invalid' : '' }}" name="route_id" id="route_id" required>
                    @foreach($routes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('route_id') ? old('route_id') : $pickupPoint->route->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('route'))
                    <div class="invalid-feedback">
                        {{ $errors->first('route') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.route_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landmark">{{ trans('cruds.pickupPoint.fields.landmark') }}</label>
                <input class="form-control {{ $errors->has('landmark') ? 'is-invalid' : '' }}" type="text" name="landmark" id="landmark" value="{{ old('landmark', $pickupPoint->landmark) }}">
                @if($errors->has('landmark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landmark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.landmark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.pickupPoint.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $pickupPoint->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pickupPoint.fields.address_helper') }}</span>
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