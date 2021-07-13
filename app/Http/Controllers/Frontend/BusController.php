<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusRequest;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Amenity;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bus_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::with(['bus_type', 'amenities', 'created_by', 'media'])->get();

        return view('frontend.buses.index', compact('buses'));
    }

    public function create()
    {
        abort_if(Gate::denies('bus_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus_types = BusType::all()->pluck('bus_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::all()->pluck('name', 'id');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.buses.create', compact('bus_types', 'amenities', 'created_bies'));
    }

    public function store(StoreBusRequest $request)
    {
        $bus = Bus::create($request->all());
        $bus->amenities()->sync($request->input('amenities', []));
        foreach ($request->input('images', []) as $file) {
            $bus->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bus->id]);
        }

        return redirect()->route('frontend.buses.index');
    }

    public function edit(Bus $bus)
    {
        abort_if(Gate::denies('bus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus_types = BusType::all()->pluck('bus_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::all()->pluck('name', 'id');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bus->load('bus_type', 'amenities', 'created_by');

        return view('frontend.buses.edit', compact('bus_types', 'amenities', 'created_bies', 'bus'));
    }

    public function update(UpdateBusRequest $request, Bus $bus)
    {
        $bus->update($request->all());
        $bus->amenities()->sync($request->input('amenities', []));
        if (count($bus->images) > 0) {
            foreach ($bus->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $bus->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $bus->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('frontend.buses.index');
    }

    public function show(Bus $bus)
    {
        abort_if(Gate::denies('bus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus->load('bus_type', 'amenities', 'created_by');

        return view('frontend.buses.show', compact('bus'));
    }

    public function destroy(Bus $bus)
    {
        abort_if(Gate::denies('bus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusRequest $request)
    {
        Bus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bus_create') && Gate::denies('bus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bus();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
