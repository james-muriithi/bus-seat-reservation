@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.trip.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trips.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="trip">{{ trans('cruds.trip.fields.trip') }}</label>
                <input class="form-control {{ $errors->has('trip') ? 'is-invalid' : '' }}" type="text" name="trip" id="trip" value="{{ old('trip', '') }}">
                @if($errors->has('trip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.trip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_id">{{ trans('cruds.trip.fields.route') }}</label>
                <select class="form-control select2 {{ $errors->has('route') ? 'is-invalid' : '' }}" name="route_id" id="route_id">
                    @foreach($routes as $id => $entry)
                        <option value="{{ $id }}" {{ old('route_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('route'))
                    <div class="invalid-feedback">
                        {{ $errors->first('route') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.route_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="travel_date">{{ trans('cruds.trip.fields.travel_date') }}</label>
                <input class="form-control date {{ $errors->has('travel_date') ? 'is-invalid' : '' }}" type="text" name="travel_date" id="travel_date" value="{{ old('travel_date') }}" required>
                @if($errors->has('travel_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('travel_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.travel_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.trip.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', '1') }}" step="1">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="created_by_id">{{ trans('cruds.trip.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id">
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('created_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('created_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.created_by_helper') }}</span>
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