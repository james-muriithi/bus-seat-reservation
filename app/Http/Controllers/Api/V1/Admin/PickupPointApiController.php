<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePickupPointRequest;
use App\Http\Requests\UpdatePickupPointRequest;
use App\Http\Resources\Admin\PickupPointResource;
use App\Models\PickupPoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PickupPointApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pickup_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PickupPointResource(PickupPoint::with(['route'])->get());
    }

    public function store(StorePickupPointRequest $request)
    {
        $pickupPoint = PickupPoint::create($request->all());

        return (new PickupPointResource($pickupPoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PickupPoint $pickupPoint)
    {
        abort_if(Gate::denies('pickup_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PickupPointResource($pickupPoint->load(['route']));
    }

    public function update(UpdatePickupPointRequest $request, PickupPoint $pickupPoint)
    {
        $pickupPoint->update($request->all());

        return (new PickupPointResource($pickupPoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        abort_if(Gate::denies('pickup_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickupPoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
