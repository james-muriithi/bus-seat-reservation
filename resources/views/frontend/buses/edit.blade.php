@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.buses.update", [$bus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="bus_name">{{ trans('cruds.bus.fields.bus_name') }}</label>
                            <input class="form-control" type="text" name="bus_name" id="bus_name" value="{{ old('bus_name', $bus->bus_name) }}" required>
                            @if($errors->has('bus_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bus_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.bus_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bus_reg_no">{{ trans('cruds.bus.fields.bus_reg_no') }}</label>
                            <input class="form-control" type="text" name="bus_reg_no" id="bus_reg_no" value="{{ old('bus_reg_no', $bus->bus_reg_no) }}" required>
                            @if($errors->has('bus_reg_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bus_reg_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.bus_reg_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bus_type_id">{{ trans('cruds.bus.fields.bus_type') }}</label>
                            <select class="form-control select2" name="bus_type_id" id="bus_type_id" required>
                                @foreach($bus_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bus_type_id') ? old('bus_type_id') : $bus->bus_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bus_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bus_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.bus_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="max_seats">{{ trans('cruds.bus.fields.max_seats') }}</label>
                            <input class="form-control" type="number" name="max_seats" id="max_seats" value="{{ old('max_seats', $bus->max_seats) }}" step="1" required>
                            @if($errors->has('max_seats'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_seats') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.max_seats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amenities">{{ trans('cruds.bus.fields.amenities') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="amenities[]" id="amenities" multiple>
                                @foreach($amenities as $id => $amenities)
                                    <option value="{{ $id }}" {{ (in_array($id, old('amenities', [])) || $bus->amenities->contains($id)) ? 'selected' : '' }}>{{ $amenities }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('amenities'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amenities') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.amenities_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" id="status" value="1" {{ $bus->status || old('status', 0) === 1 ? 'checked' : '' }}>
                                <label for="status">{{ trans('cruds.bus.fields.status') }}</label>
                            </div>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="created_by_id">{{ trans('cruds.bus.fields.created_by') }}</label>
                            <select class="form-control select2" name="created_by_id" id="created_by_id">
                                @foreach($created_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('created_by_id') ? old('created_by_id') : $bus->created_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('created_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('created_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.created_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="images">{{ trans('cruds.bus.fields.images') }}</label>
                            <div class="needsclick dropzone" id="images-dropzone">
                            </div>
                            @if($errors->has('images'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('images') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bus.fields.images_helper') }}</span>
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
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('frontend.buses.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($bus) && $bus->images)
      var files = {!! json_encode($bus->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
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