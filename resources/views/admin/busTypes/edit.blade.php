@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.busType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bus-types.update", [$busType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bus_type">{{ trans('cruds.busType.fields.bus_type') }}</label>
                <input class="form-control {{ $errors->has('bus_type') ? 'is-invalid' : '' }}" type="text" name="bus_type" id="bus_type" value="{{ old('bus_type', $busType->bus_type) }}" required>
                @if($errors->has('bus_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bus_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.busType.fields.bus_type_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $busType->status || old('status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.busType.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.busType.fields.status_helper') }}</span>
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