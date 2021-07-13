@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.busSeatClass.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bus-seat-classes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.busSeatClass.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $busSeatClass->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.busSeatClass.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $busSeatClass->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.busSeatClass.fields.color') }}
                                    </th>
                                    <td>
                                        {{ $busSeatClass->color }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.busSeatClass.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $busSeatClass->status }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bus-seat-classes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection