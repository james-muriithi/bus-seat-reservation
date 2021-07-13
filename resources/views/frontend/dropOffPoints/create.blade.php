@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.dropOffPoint.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.drop-off-points.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="drop_off_point">{{ trans('cruds.dropOffPoint.fields.drop_off_point') }}</label>
                            <input class="form-control" type="text" name="drop_off_point" id="drop_off_point" value="{{ old('drop_off_point', '') }}" required>
                            @if($errors->has('drop_off_point'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('drop_off_point') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dropOffPoint.fields.drop_off_point_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="drop_time">{{ trans('cruds.dropOffPoint.fields.drop_time') }}</label>
                            <input class="form-control timepicker" type="text" name="drop_time" id="drop_time" value="{{ old('drop_time') }}" required>
                            @if($errors->has('drop_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('drop_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dropOffPoint.fields.drop_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="landmark">{{ trans('cruds.dropOffPoint.fields.landmark') }}</label>
                            <input class="form-control" type="text" name="landmark" id="landmark" value="{{ old('landmark', '') }}">
                            @if($errors->has('landmark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('landmark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dropOffPoint.fields.landmark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.dropOffPoint.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dropOffPoint.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="route_id">{{ trans('cruds.dropOffPoint.fields.route') }}</label>
                            <select class="form-control select2" name="route_id" id="route_id" required>
                                @foreach($routes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('route_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('route'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('route') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dropOffPoint.fields.route_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection