<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusSeatClassRequest;
use App\Http\Requests\UpdateBusSeatClassRequest;
use App\Http\Resources\Admin\BusSeatClassResource;
use App\Models\BusSeatClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusSeatClassApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_seat_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusSeatClassResource(BusSeatClass::all());
    }

    public function store(StoreBusSeatClassRequest $request)
    {
        $busSeatClass = BusSeatClass::create($request->all());

        return (new BusSeatClassResource($busSeatClass))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BusSeatClass $busSeatClass)
    {
        abort_if(Gate::denies('bus_seat_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusSeatClassResource($busSeatClass);
    }

    public function update(UpdateBusSeatClassRequest $request, BusSeatClass $busSeatClass)
    {
        $busSeatClass->update($request->all());

        return (new BusSeatClassResource($busSeatClass))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BusSeatClass $busSeatClass)
    {
        abort_if(Gate::denies('bus_seat_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busSeatClass->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
