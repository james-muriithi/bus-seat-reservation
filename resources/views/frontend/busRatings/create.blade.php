@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.busRating.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bus-ratings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="bus_quality">{{ trans('cruds.busRating.fields.bus_quality') }}</label>
                            <input class="form-control" type="number" name="bus_quality" id="bus_quality" value="{{ old('bus_quality', '') }}" step="1" required>
                            @if($errors->has('bus_quality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bus_quality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busRating.fields.bus_quality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="punctuality">{{ trans('cruds.busRating.fields.punctuality') }}</label>
                            <input class="form-control" type="number" name="punctuality" id="punctuality" value="{{ old('punctuality', '') }}" step="1">
                            @if($errors->has('punctuality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('punctuality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busRating.fields.punctuality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="staff_behaviour">{{ trans('cruds.busRating.fields.staff_behaviour') }}</label>
                            <input class="form-control" type="number" name="staff_behaviour" id="staff_behaviour" value="{{ old('staff_behaviour', '') }}" step="1">
                            @if($errors->has('staff_behaviour'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('staff_behaviour') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busRating.fields.staff_behaviour_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.busRating.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment') }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busRating.fields.comment_helper') }}</span>
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