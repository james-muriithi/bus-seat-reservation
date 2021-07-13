<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Http\Resources\Admin\BusResource;
use App\Models\Bus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bus_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusResource(Bus::with(['bus_type', 'amenities', 'created_by'])->get());
    }

    public function store(StoreBusRequest $request)
    {
        $bus = Bus::create($request->all());
        $bus->amenities()->sync($request->input('amenities', []));
        if ($request->input('images', false)) {
            $bus->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
        }

        return (new BusResource($bus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bus $bus)
    {
        abort_if(Gate::denies('bus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusResource($bus->load(['bus_type', 'amenities', 'created_by']));
    }

    public function update(UpdateBusRequest $request, Bus $bus)
    {
        $bus->update($request->all());
        $bus->amenities()->sync($request->input('amenities', []));
        if ($request->input('images', false)) {
            if (!$bus->images || $request->input('images') !== $bus->images->file_name) {
                if ($bus->images) {
                    $bus->images->delete();
                }
                $bus->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
            }
        } elseif ($bus->images) {
            $bus->images->delete();
        }

        return (new BusResource($bus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bus $bus)
    {
        abort_if(Gate::denies('bus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
