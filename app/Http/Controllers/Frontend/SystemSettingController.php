<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySystemSettingRequest;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use App\Models\Currency;
use App\Models\SystemSetting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SystemSettingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('system_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSettings = SystemSetting::with(['default_currency', 'media'])->get();

        return view('frontend.systemSettings.index', compact('systemSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('system_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $default_currencies = Currency::all()->pluck('currency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.systemSettings.create', compact('default_currencies'));
    }

    public function store(StoreSystemSettingRequest $request)
    {
        $systemSetting = SystemSetting::create($request->all());

        if ($request->input('company_logo', false)) {
            $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $systemSetting->id]);
        }

        return redirect()->route('frontend.system-settings.index');
    }

    public function edit(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $default_currencies = Currency::all()->pluck('currency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $systemSetting->load('default_currency');

        return view('frontend.systemSettings.edit', compact('default_currencies', 'systemSetting'));
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

        return redirect()->route('frontend.system-settings.index');
    }

    public function show(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSetting->load('default_currency');

        return view('frontend.systemSettings.show', compact('systemSetting'));
    }

    public function destroy(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroySystemSettingRequest $request)
    {
        SystemSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('system_setting_create') && Gate::denies('system_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SystemSetting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
