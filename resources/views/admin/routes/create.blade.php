@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.route.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.routes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bus_id">{{ trans('cruds.route.fields.bus') }}</label>
                <select class="form-control select2 {{ $errors->has('bus') ? 'is-invalid' : '' }}" name="bus_id" id="bus_id" required>
                    @foreach($buses as $id => $entry)
                        <option value="{{ $id }}" {{ old('bus_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.bus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="board_point">{{ trans('cruds.route.fields.board_point') }}</label>
                <input class="form-control {{ $errors->has('board_point') ? 'is-invalid' : '' }}" type="text" name="board_point" id="board_point" value="{{ old('board_point', '') }}" required>
                @if($errors->has('board_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.board_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="board_time">{{ trans('cruds.route.fields.board_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('board_time') ? 'is-invalid' : '' }}" type="text" name="board_time" id="board_time" value="{{ old('board_time') }}" required>
                @if($errors->has('board_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.board_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="drop_point">{{ trans('cruds.route.fields.drop_point') }}</label>
                <input class="form-control {{ $errors->has('drop_point') ? 'is-invalid' : '' }}" type="text" name="drop_point" id="drop_point" value="{{ old('drop_point', '') }}" required>
                @if($errors->has('drop_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drop_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.drop_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="drop_time">{{ trans('cruds.route.fields.drop_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('drop_time') ? 'is-invalid' : '' }}" type="text" name="drop_time" id="drop_time" value="{{ old('drop_time') }}" required>
                @if($errors->has('drop_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drop_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.drop_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fare">{{ trans('cruds.route.fields.fare') }}</label>
                <input class="form-control {{ $errors->has('fare') ? 'is-invalid' : '' }}" type="number" name="fare" id="fare" value="{{ old('fare', '') }}" step="0.01" required>
                @if($errors->has('fare'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fare') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.fare_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', 0) == 1 || old('status') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.route.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.route.fields.status_helper') }}</span>
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