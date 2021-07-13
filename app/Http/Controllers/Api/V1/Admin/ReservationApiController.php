<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\Admin\ReservationResource;
use App\Models\Reservation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReservationResource(Reservation::with(['passenger', 'route', 'pickup_point', 'seats'])->get());
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        $reservation->seats()->sync($request->input('seats', []));

        return (new ReservationResource($reservation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReservationResource($reservation->load(['passenger', 'route', 'pickup_point', 'seats']));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        $reservation->seats()->sync($request->input('seats', []));

        return (new ReservationResource($reservation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
