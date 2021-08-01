<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPassengerRequest;
use App\Http\Requests\StorePassengerRequest;
use App\Http\Requests\UpdatePassengerRequest;
use App\Http\Resources\Admin\PassengerResource;
use App\Models\Passenger;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PassengerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('passenger_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::with(['media'])->latest()->get();

        if ($request->ajax()) {
            return new PassengerResource($passengers);
        }

        return view('admin.passengers.index', compact('passengers'));
    }

    public function create()
    {
        abort_if(Gate::denies('passenger_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.passengers.create');
    }

    public function store(StorePassengerRequest $request)
    {
        $passenger = Passenger::create($request->all());

        if ($request->input('avatar', false)) {
            $passenger->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $passenger->id]);
        }

        return redirect()->route('admin.passengers.index');
    }

    public function edit(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.passengers.edit', compact('passenger'));
    }

    public function update(UpdatePassengerRequest $request, Passenger $passenger)
    {
        $passenger->update($request->all());

        if ($request->input('avatar', false)) {
            if (!$passenger->avatar || $request->input('avatar') !== $passenger->avatar->file_name) {
                if ($passenger->avatar) {
                    $passenger->avatar->delete();
                }
                $passenger->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
            }
        } elseif ($passenger->avatar) {
            $passenger->avatar->delete();
        }

        return redirect()->route('admin.passengers.index');
    }

    public function show(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.passengers.show', compact('passenger'));
    }

    public function destroy(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passenger->delete();

        return back();
    }

    public function massDestroy(MassDestroyPassengerRequest $request)
    {
        Passenger::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('passenger_create') && Gate::denies('passenger_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Passenger();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
