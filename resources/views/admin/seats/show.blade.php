@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.id') }}
                        </th>
                        <td>
                            {{ $seat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.bus') }}
                        </th>
                        <td>
                            {{ $seat->bus->bus_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.row') }}
                        </th>
                        <td>
                            {{ $seat->row }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.column') }}
                        </th>
                        <td>
                            {{ $seat->column }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.name') }}
                        </th>
                        <td>
                            {{ $seat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seat.fields.details') }}
                        </th>
                        <td>
                            {{ $seat->details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection