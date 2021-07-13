<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDropOffPointRequest;
use App\Http\Requests\UpdateDropOffPointRequest;
use App\Http\Resources\Admin\DropOffPointResource;
use App\Models\DropOffPoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DropOffPointApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drop_off_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DropOffPointResource(DropOffPoint::with(['route'])->get());
    }

    public function store(StoreDropOffPointRequest $request)
    {
        $dropOffPoint = DropOffPoint::create($request->all());

        return (new DropOffPointResource($dropOffPoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DropOffPoint $dropOffPoint)
    {
        abort_if(Gate::denies('drop_off_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DropOffPointResource($dropOffPoint->load(['route']));
    }

    public function update(UpdateDropOffPointRequest $request, DropOffPoint $dropOffPoint)
    {
        $dropOffPoint->update($request->all());

        return (new DropOffPointResource($dropOffPoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DropOffPoint $dropOffPoint)
    {
        abort_if(Gate::denies('drop_off_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dropOffPoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
