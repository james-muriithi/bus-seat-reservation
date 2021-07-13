<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePassengerRequest;
use App\Http\Requests\UpdatePassengerRequest;
use App\Http\Resources\Admin\PassengerResource;
use App\Models\Passenger;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PassengerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('passenger_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PassengerResource(Passenger::all());
    }

    public function store(StorePassengerRequest $request)
    {
        $passenger = Passenger::create($request->all());

        if ($request->input('avatar', false)) {
            $passenger->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
        }

        return (new PassengerResource($passenger))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PassengerResource($passenger);
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

        return (new PassengerResource($passenger))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Passenger $passenger)
    {
        abort_if(Gate::denies('passenger_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passenger->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
