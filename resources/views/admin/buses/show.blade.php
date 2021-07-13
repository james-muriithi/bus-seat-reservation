@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.id') }}
                        </th>
                        <td>
                            {{ $bus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.bus_name') }}
                        </th>
                        <td>
                            {{ $bus->bus_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.bus_reg_no') }}
                        </th>
                        <td>
                            {{ $bus->bus_reg_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.bus_type') }}
                        </th>
                        <td>
                            {{ $bus->bus_type->bus_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.max_seats') }}
                        </th>
                        <td>
                            {{ $bus->max_seats }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.amenities') }}
                        </th>
                        <td>
                            @foreach($bus->amenities as $key => $amenities)
                                <span class="label label-info">{{ $amenities->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bus->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.created_by') }}
                        </th>
                        <td>
                            {{ $bus->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bus.fields.images') }}
                        </th>
                        <td>
                            @foreach($bus->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection