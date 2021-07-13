@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.systemSetting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.system-settings.update", [$systemSetting->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="default_currency_id">{{ trans('cruds.systemSetting.fields.default_currency') }}</label>
                            <select class="form-control select2" name="default_currency_id" id="default_currency_id" required>
                                @foreach($default_currencies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('default_currency_id') ? old('default_currency_id') : $systemSetting->default_currency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('default_currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.default_currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_name">{{ trans('cruds.systemSetting.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', $systemSetting->company_name) }}" required>
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_logo">{{ trans('cruds.systemSetting.fields.company_logo') }}</label>
                            <div class="needsclick dropzone" id="company_logo-dropzone">
                            </div>
                            @if($errors->has('company_logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.company_logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="smtp_username">{{ trans('cruds.systemSetting.fields.smtp_username') }}</label>
                            <input class="form-control" type="text" name="smtp_username" id="smtp_username" value="{{ old('smtp_username', $systemSetting->smtp_username) }}">
                            @if($errors->has('smtp_username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('smtp_username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.smtp_username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="smtp_host">{{ trans('cruds.systemSetting.fields.smtp_host') }}</label>
                            <input class="form-control" type="text" name="smtp_host" id="smtp_host" value="{{ old('smtp_host', $systemSetting->smtp_host) }}">
                            @if($errors->has('smtp_host'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('smtp_host') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.smtp_host_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="smtp_password">{{ trans('cruds.systemSetting.fields.smtp_password') }}</label>
                            <input class="form-control" type="text" name="smtp_password" id="smtp_password" value="{{ old('smtp_password', $systemSetting->smtp_password) }}">
                            @if($errors->has('smtp_password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('smtp_password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.systemSetting.fields.smtp_password_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.companyLogoDropzone = {
    url: '{{ route('frontend.system-settings.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="company_logo"]').remove()
      $('form').append('<input type="hidden" name="company_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="company_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($systemSetting) && $systemSetting->company_logo)
      var file = {!! json_encode($systemSetting->company_logo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="company_logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection