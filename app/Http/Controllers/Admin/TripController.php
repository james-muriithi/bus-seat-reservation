<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\Admin\TripResource;
use App\Models\Route;
use App\Models\Trip;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::with(['route', 'created_by', 'reservations', 'trip_seat_classes']);

        if ($request->query("bus")) {
            $trips = $trips->whereHas('route', function ($query) use ($request) {
                $query->where('bus_id', $request->query("bus"));
            });
        }
        if ($request->query("route")) {
            $trips = $trips->where('route_id', $request->query("route"));
        }

        $trips = $trips->latest()
            ->get();

        if ($request->ajax()) {
            return new TripResource($trips);
        }

        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trips.create', compact('routes', 'created_bies'));
    }

    public function store(StoreTripRequest $request)
    {
        $request->merge(["trip_id" => $this->generateTripId()]);

        $trip = Trip::create($request->all());
        $trip->created_by()->associate(auth()->id());

        if (count($request->input('seat_classes', [])) > 0) {
            $trip->fare = max($request->input('seat_classes'));
            $trip->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $trip->trip_seat_classes()->sync($seatClasses);
        }

        if ($request->ajax()) {
            return (new TripResource($trip))->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.trips.index');
    }

    public function edit(Trip $trip)
    {
        abort_if(Gate::denies('trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trip->load('route', 'created_by');

        return view('admin.trips.edit', compact('routes', 'created_bies', 'trip'));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->update($request->only(['fare', 'status', 'route_id', 'travel_date']));

        if (count($request->input('seat_classes', [])) > 0) {
            $trip->fare = max($request->input('seat_classes'));
            $trip->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $trip->trip_seat_classes()->sync($seatClasses);
        } else {
            if (null == $request->input('fare', null)) {
                $trip->fare = null;
                $trip->save();
            }
            $trip->trip_seat_classes()->sync([]);
        }

        if ($request->ajax()) {
            return (new TripResource($trip))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }

        return redirect()->route('admin.trips.index');
    }

    public function show(Trip $trip)
    {
        abort_if(Gate::denies('trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->load('route', 'created_by', 'reservations');

        return view('admin.trips.show', compact('trip'));
    }

    public function destroy(Trip $trip)
    {
        abort_if(Gate::denies('trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTripRequest $request)
    {
        Trip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function generateTripId($length = 7, $prefix = 'TR-', $uppercase = true)
    {
        $random = substr(str_shuffle(MD5(microtime())), 0, $length);
        if ($uppercase) {
            $random = strtoupper($random);
        }
        return $prefix . $random;
    }
}
