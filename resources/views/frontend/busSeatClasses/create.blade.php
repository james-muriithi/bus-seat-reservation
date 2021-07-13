@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.busSeatClass.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bus-seat-classes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.busSeatClass.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busSeatClass.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="color">{{ trans('cruds.busSeatClass.fields.color') }}</label>
                            <input class="form-control" type="text" name="color" id="color" value="{{ old('color', '') }}" required>
                            @if($errors->has('color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busSeatClass.fields.color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.busSeatClass.fields.status') }}</label>
                            <input class="form-control" type="number" name="status" id="status" value="{{ old('status', '1') }}" step="1">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.busSeatClass.fields.status_helper') }}</span>
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