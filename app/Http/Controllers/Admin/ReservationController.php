<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Passenger;
use App\Models\PickupPoint;
use App\Models\Reservation;
use App\Models\Seat;
use App\Models\Trip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservations = Reservation::with(['passengers', 'pickup_point', 'trip', 'seats'])->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        abort_if(Gate::denies('reservation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::pluck('name', 'id');

        $pickup_points = PickupPoint::pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('trip', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seats = Seat::pluck('row', 'id');

        return view('admin.reservations.create', compact('passengers', 'pickup_points', 'trips', 'seats'));
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        $reservation->passengers()->sync($request->input('passengers', []));
        $reservation->seats()->sync($request->input('seats', []));

        return redirect()->route('admin.reservations.index');
    }

    public function edit(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::pluck('name', 'id');

        $pickup_points = PickupPoint::pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('trip', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seats = Seat::pluck('row', 'id');

        $reservation->load('passengers', 'pickup_point', 'trip', 'seats');

        return view('admin.reservations.edit', compact('passengers', 'pickup_points', 'trips', 'seats', 'reservation'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        $reservation->passengers()->sync($request->input('passengers', []));
        $reservation->seats()->sync($request->input('seats', []));

        return redirect()->route('admin.reservations.index');
    }

    public function show(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->load('passengers', 'pickup_point', 'trip', 'seats');

        return view('admin.reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->delete();

        return back();
    }

    public function massDestroy(MassDestroyReservationRequest $request)
    {
        Reservation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
