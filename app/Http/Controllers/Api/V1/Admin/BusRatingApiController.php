<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusRatingRequest;
use App\Http\Requests\UpdateBusRatingRequest;
use App\Http\Resources\Admin\BusRatingResource;
use App\Models\BusRating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusRatingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusRatingResource(BusRating::all());
    }

    public function store(StoreBusRatingRequest $request)
    {
        $busRating = BusRating::create($request->all());

        return (new BusRatingResource($busRating))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BusRating $busRating)
    {
        abort_if(Gate::denies('bus_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusRatingResource($busRating);
    }

    public function update(UpdateBusRatingRequest $request, BusRating $busRating)
    {
        $busRating->update($request->all());

        return (new BusRatingResource($busRating))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BusRating $busRating)
    {
        abort_if(Gate::denies('bus_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busRating->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
