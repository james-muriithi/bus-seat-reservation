@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.routePriceVariation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.route-price-variations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="pickup_point_id">{{ trans('cruds.routePriceVariation.fields.pickup_point') }}</label>
                <select class="form-control select2 {{ $errors->has('pickup_point') ? 'is-invalid' : '' }}" name="pickup_point_id" id="pickup_point_id" required>
                    @foreach($pickup_points as $id => $entry)
                        <option value="{{ $id }}" {{ old('pickup_point_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pickup_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.routePriceVariation.fields.pickup_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="drop_point_id">{{ trans('cruds.routePriceVariation.fields.drop_point') }}</label>
                <select class="form-control select2 {{ $errors->has('drop_point') ? 'is-invalid' : '' }}" name="drop_point_id" id="drop_point_id" required>
                    @foreach($drop_points as $id => $entry)
                        <option value="{{ $id }}" {{ old('drop_point_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('drop_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drop_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.routePriceVariation.fields.drop_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seat_classes">{{ trans('cruds.routePriceVariation.fields.seat_class') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('seat_classes') ? 'is-invalid' : '' }}" name="seat_classes[]" id="seat_classes" multiple>
                    @foreach($seat_classes as $id => $seat_class)
                        <option value="{{ $id }}" {{ in_array($id, old('seat_classes', [])) ? 'selected' : '' }}>{{ $seat_class }}</option>
                    @endforeach
                </select>
                @if($errors->has('seat_classes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat_classes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.routePriceVariation.fields.seat_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fare">{{ trans('cruds.routePriceVariation.fields.fare') }}</label>
                <input class="form-control {{ $errors->has('fare') ? 'is-invalid' : '' }}" type="number" name="fare" id="fare" value="{{ old('fare', '') }}" step="0.01">
                @if($errors->has('fare'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fare') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.routePriceVariation.fields.fare_helper') }}</span>
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