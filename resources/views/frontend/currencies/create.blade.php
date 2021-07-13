@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.currency.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.currencies.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="currency_code">{{ trans('cruds.currency.fields.currency_code') }}</label>
                            <input class="form-control" type="text" name="currency_code" id="currency_code" value="{{ old('currency_code', '') }}" required>
                            @if($errors->has('currency_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.currency_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="currency_name">{{ trans('cruds.currency.fields.currency_name') }}</label>
                            <input class="form-control" type="text" name="currency_name" id="currency_name" value="{{ old('currency_name', '') }}" required>
                            @if($errors->has('currency_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.currency_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="currency_symbol">{{ trans('cruds.currency.fields.currency_symbol') }}</label>
                            <input class="form-control" type="text" name="currency_symbol" id="currency_symbol" value="{{ old('currency_symbol', '') }}" required>
                            @if($errors->has('currency_symbol'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency_symbol') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.currency_symbol_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" id="status" value="1" {{ old('status', 0) == 1 || old('status') === null ? 'checked' : '' }}>
                                <label for="status">{{ trans('cruds.currency.fields.status') }}</label>
                            </div>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.status_helper') }}</span>
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