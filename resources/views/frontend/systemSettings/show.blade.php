@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.systemSetting.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.system-settings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.default_currency') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->default_currency->currency_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.company_name') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.company_logo') }}
                                    </th>
                                    <td>
                                        @if($systemSetting->company_logo)
                                            <a href="{{ $systemSetting->company_logo->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.smtp_username') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->smtp_username }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.smtp_host') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->smtp_host }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.smtp_password') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->smtp_password }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.system-settings.index') }}">
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