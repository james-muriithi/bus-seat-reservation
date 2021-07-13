@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.seat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.seats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bus_id">{{ trans('cruds.seat.fields.bus') }}</label>
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
                <span class="help-block">{{ trans('cruds.seat.fields.bus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="row">{{ trans('cruds.seat.fields.row') }}</label>
                <input class="form-control {{ $errors->has('row') ? 'is-invalid' : '' }}" type="number" name="row" id="row" value="{{ old('row', '') }}" step="1" required>
                @if($errors->has('row'))
                    <div class="invalid-feedback">
                        {{ $errors->first('row') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seat.fields.row_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="column">{{ trans('cruds.seat.fields.column') }}</label>
                <input class="form-control {{ $errors->has('column') ? 'is-invalid' : '' }}" type="number" name="column" id="column" value="{{ old('column', '') }}" step="1" required>
                @if($errors->has('column'))
                    <div class="invalid-feedback">
                        {{ $errors->first('column') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seat.fields.column_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.seat.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seat.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.seat.fields.details') }}</label>
                <input class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" type="text" name="details" id="details" value="{{ old('details', '') }}">
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seat.fields.details_helper') }}</span>
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