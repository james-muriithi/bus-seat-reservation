@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.passenger.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.passengers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.id') }}
                        </th>
                        <td>
                            {{ $passenger->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.name') }}
                        </th>
                        <td>
                            {{ $passenger->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.mobile') }}
                        </th>
                        <td>
                            {{ $passenger->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.email') }}
                        </th>
                        <td>
                            {{ $passenger->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.age') }}
                        </th>
                        <td>
                            {{ $passenger->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Passenger::GENDER_RADIO[$passenger->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.avatar') }}
                        </th>
                        <td>
                            @if($passenger->avatar)
                                <a href="{{ $passenger->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $passenger->avatar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.passengers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection