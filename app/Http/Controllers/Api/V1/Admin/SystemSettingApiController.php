<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use App\Http\Resources\Admin\SystemSettingResource;
use App\Models\SystemSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemSettingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('system_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemSettingResource(SystemSetting::with(['default_currency'])->get());
    }

    public function store(StoreSystemSettingRequest $request)
    {
        $systemSetting = SystemSetting::create($request->all());

        if ($request->input('company_logo', false)) {
            $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
        }

        return (new SystemSettingResource($systemSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemSettingResource($systemSetting->load(['default_currency']));
    }

    public function update(UpdateSystemSettingRequest $request, SystemSetting $systemSetting)
    {
        $systemSetting->update($request->all());

        if ($request->input('company_logo', false)) {
            if (!$systemSetting->company_logo || $request->input('company_logo') !== $systemSetting->company_logo->file_name) {
                if ($systemSetting->company_logo) {
                    $systemSetting->company_logo->delete();
                }
                $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
            }
        } elseif ($systemSetting->company_logo) {
            $systemSetting->company_logo->delete();
        }

        return (new SystemSettingResource($systemSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
