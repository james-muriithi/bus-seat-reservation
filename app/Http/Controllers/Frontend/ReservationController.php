<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Passenger;
use App\Models\PickupPoint;
use App\Models\Reservation;
use App\Models\Route;
use App\Models\Seat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservations = Reservation::with(['passenger', 'route', 'pickup_point', 'seats'])->get();

        return view('frontend.reservations.index', compact('reservations'));
    }

    public function create()
    {
        abort_if(Gate::denies('reservation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pickup_points = PickupPoint::all()->pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seats = Seat::all()->pluck('row', 'id');

        return view('frontend.reservations.create', compact('passengers', 'routes', 'pickup_points', 'seats'));
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        $reservation->seats()->sync($request->input('seats', []));

        return redirect()->route('frontend.reservations.index');
    }

    public function edit(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $passengers = Passenger::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pickup_points = PickupPoint::all()->pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seats = Seat::all()->pluck('row', 'id');

        $reservation->load('passenger', 'route', 'pickup_point', 'seats');

        return view('frontend.reservations.edit', compact('passengers', 'routes', 'pickup_points', 'seats', 'reservation'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        $reservation->seats()->sync($request->input('seats', []));

        return redirect()->route('frontend.reservations.index');
    }

    public function show(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->load('passenger', 'route', 'pickup_point', 'seats');

        return view('frontend.reservations.show', compact('reservation'));
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
