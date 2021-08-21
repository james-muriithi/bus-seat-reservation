@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.routePriceVariation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.route-price-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.routePriceVariation.fields.id') }}
                        </th>
                        <td>
                            {{ $routePriceVariation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routePriceVariation.fields.pickup_point') }}
                        </th>
                        <td>
                            {{ $routePriceVariation->pickup_point->pickup_point ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routePriceVariation.fields.drop_point') }}
                        </th>
                        <td>
                            {{ $routePriceVariation->drop_point->drop_off_point ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routePriceVariation.fields.seat_class') }}
                        </th>
                        <td>
                            @foreach($routePriceVariation->seat_classes as $key => $seat_class)
                                <span class="label label-info">{{ $seat_class->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.routePriceVariation.fields.fare') }}
                        </th>
                        <td>
                            {{ $routePriceVariation->fare }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.route-price-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection