<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FPDF\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\Admin\ReservationResource;
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
    public function index(Request $request)
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservations = Reservation::with(['seats', 'pickup_point', 'trip', 'drop_point']);

        if ($request->query("trip")) {
            $reservations = $reservations->where("trip_id", $request->query("trip"));
        }

        $reservations = $reservations->latest()->get();

        if ($request->ajax()) {
            return new ReservationResource($reservations);
        }

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

    public function tickets(Reservation $reservation)
    {
        $manifests = collect([]);
        $reservation->load('seats', 'trip');

        foreach ($reservation->seats as $seat) {
            $manifest = [
                "ticket_number" => $seat->reservation->ticket_number,
                "reservation_ref" => $reservation->ref,
                "route_name" => $reservation->trip->route->route_name,
                "seat_number" => $seat->name,
                "travel_date" => $reservation->trip->travel_date,
                "pickup_time" => $reservation->trip->route->board_time,
                "amount_paid" => $seat->reservation->amount_paid,
                "reservation_date" => $reservation->created_at,
                "pickup_point" => $reservation->pickup_point->pickup_point,
                "drop_point" => $reservation->drop_point->drop_off_point,
                "bus" => $reservation->trip->bus->bus_reg_no,
                "passenger_name" => $seat->reservation->passenger->name,
            ];

            $manifests->push($manifest);
        }


        $tt = new Ticket();

        foreach ($manifests as $manifest) {
            $manifest = (object) $manifest;
            $tt->print(
                $manifest->passenger_name,
                $manifest->pickup_point,
                $manifest->drop_point,
                $manifest->ticket_number,
                $manifest->travel_date,
                $manifest->pickup_time,
                floatval($manifest->amount_paid),
                $manifest->seat_number,
            );
        }

        $tt->save();

        echo json_encode($manifests);
    }
}
