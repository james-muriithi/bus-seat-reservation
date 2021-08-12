<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusRequest;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Http\Resources\Admin\BusResource;
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

    public function index(Request $request)
    {
        abort_if(Gate::denies('bus_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::with(['bus_type', 'amenities', 'created_by', 'seat_classes'])
            ->select(sprintf('%s.*', (new Bus())->table));

        if ($request->query('active')) {
            $buses = $buses->active();
        }
        $buses = $buses->latest()->get();

        if ($request->ajax()) {
            return new BusResource($buses);
        }

        return view('admin.buses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bus_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus_types = BusType::all()->pluck('bus_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::all()->pluck('name', 'id');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.buses.create', compact('bus_types', 'amenities', 'created_bies'));
    }

    public function store(StoreBusRequest $request)
    {
        $request->merge(['status' => (int)$request->input('status')]);
        $bus = Bus::create($request->all());
        $bus->created_by()->associate(auth()->user());
        $bus->save();
        $bus->amenities()->sync($request->input('amenities', []));
        $bus->seat_classes()->sync($request->input('seat_classes', []));

        foreach ($request->input('images', []) as $file) {
            $bus->addMediaFromBase64($file['path'])
                ->usingFileName(uniqid() . '_' . $file['name'])
                ->toMediaCollection('images');
        }

        if ($request->ajax()) {
            return (new BusResource($bus))->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.buses.index');
    }

    public function edit(Bus $bus)
    {
        abort_if(Gate::denies('bus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus_types = BusType::all()->pluck('bus_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::all()->pluck('name', 'id');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bus->load('bus_type', 'amenities', 'created_by', 'seat_classes');

        return view('admin.buses.edit', compact('bus_types', 'amenities', 'created_bies', 'bus'));
    }

    public function update(UpdateBusRequest $request, Bus $bus)
    {
        $request->merge(['status' => (int)(bool)$request->input('status', 0)]);

        $bus->update($request->all());

        $bus->amenities()->sync($request->input('amenities', []));
        $bus->seat_classes()->sync($request->input('seat_classes', []));
        if (count($bus->images) > 0) {
            foreach ($bus->images as $media) {
                $fileNames = collect($request->input('images', []))->pluck('name')->all();
                if (!in_array($media->file_name, $fileNames)) {
                    $media->delete();
                }
            }
        }
        $media = $bus->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file['name'], $media)) {
                $bus->addMediaFromBase64($file['path'])
                    ->usingFileName(uniqid() . '_' . $file['name'])
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.buses.index');
    }

    public function show(Request $request, Bus $bus)
    {
        abort_if(Gate::denies('bus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus->load('bus_type', 'amenities', 'created_by', 'seat_classes', 'seat_layout');

        if ($request->ajax()) {
            return new BusResource($bus);
        }

        return view('admin.buses.show', compact('bus'));
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
