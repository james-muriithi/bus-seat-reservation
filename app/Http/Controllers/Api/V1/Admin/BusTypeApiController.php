<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusTypeRequest;
use App\Http\Requests\UpdateBusTypeRequest;
use App\Http\Resources\Admin\BusTypeResource;
use App\Models\BusType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusTypeResource(BusType::all());
    }

    public function store(StoreBusTypeRequest $request)
    {
        $busType = BusType::create($request->all());

        return (new BusTypeResource($busType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BusType $busType)
    {
        abort_if(Gate::denies('bus_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusTypeResource($busType);
    }

    public function update(UpdateBusTypeRequest $request, BusType $busType)
    {
        $busType->update($request->all());

        return (new BusTypeResource($busType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BusType $busType)
    {
        abort_if(Gate::denies('bus_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
