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
use Illuminate\Support\Carbon;
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

        if ($request->query("travel_date")) {
            $trips = $trips->whereDate('travel_date', $request->query("travel_date"));
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

    public function show(Trip $trip, Request $request)
    {
        abort_if(Gate::denies('trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->load('route', 'created_by', 'reservations');

        if ($request->ajax()) {
            return new TripResource($trip);
        }

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

    public function manifest(Trip $trip, Request $request)
    {
        $manifests = collect([]);
        $reservations = $trip->reservations->load('seats');

        foreach ($reservations as $reservation) {

            foreach ($reservation->seats as $seat) {
                $manifest = [
                    "ticket_number" => $seat->reservation->ticket_number,
                    "reservation_ref" => $reservation->ref,
                    "route" => $trip->route,
                    "route_name" => $trip->route->route_name,
                    "seat_number" => $seat->name,
                    "travel_date" => $trip->travel_date,
                    "board_time" => $trip->route->board_time,
                    "amount_paid" => $seat->reservation->amount_paid,
                    "reservation_date" => $reservation->created_at,
                    "pickup_point" => $reservation->pickup_point->pickup_point,
                    "drop_point" => $reservation->drop_point->drop_off_point,
                    "bus" => $trip->bus,
                    "passenger" => $seat->reservation->passenger,
                    "passenger_name" => $seat->reservation->passenger->name,
                ];

                $manifests->push($manifest);
            }
        }
        $manifests->sortByDesc('reservation_date');

        if ($request->ajax()) {
            return new TripResource($manifests);
        }
    }

    public function generateTripId($length = 7, $prefix = 'TR-', $uppercase = true)
    {
        $random = substr(str_shuffle(MD5(microtime())), 0, $length);
        if ($uppercase) {
            $random = strtoupper($random);
        }
        return $prefix . $random;
    }

    public function search($from, $to, Request $request)
    {
        $travelDate = "2021-08-24";

        $trips = Trip::active()->whereHas('route', function ($query) use ($from, $to) {
            $query->whereHas('pickup_points', function ($query) use ($from) {
                $query->where("pickup_point", $from);
            })->whereHas('drop_off_points', function ($query) use ($to) {
                $query->where("drop_off_point", $to);
            });
        })
            ->with('route.fare_variations')
            ->with('route.bus.amenities')
            ->whereDate("travel_date", $travelDate)
            ->get();

        $formattedTrips = collect([
            "search" => [
                "from" => $from,
                "to" => $to
            ],
            "trips_count" => $trips->count() 
        ]);

        foreach ($trips as $trip) {

            $pickup_time = $trip->route->board_time;

            $tripPriceList = [];

            // fare variations
            $fareVariation = $trip->route->fare_variations()
                ->whereHas('pickup_point', function ($query) use ($from) {
                    $query->where('pickup_point', $from);
                })->whereHas('drop_point', function ($query) use ($to) {
                    $query->where('drop_off_point', $to);
                })->first();

            if ($fareVariation) {
                if ($fareVariation->seatClassesFare->count() > 0) {
                    $tripPriceList = $fareVariation->seatClassesFare
                        ->map(function ($seatClass) {
                            return [
                                'fare' => $seatClass->fare,
                                'color' => $seatClass->color,
                                'currencyCode' => $seatClass->currencyCode ?? 'Ksh',
                                'seatType' => $seatClass->name
                            ];
                        });
                } else {
                    $tripPriceList = $trip->route->bus->seat_classes
                        ->map(function ($seatClass) use ($fareVariation) {
                            return [
                                'fare' => $fareVariation->fare,
                                'color' => $seatClass->color,
                                'currencyCode' => $seatClass->currencyCode ?? 'Ksh',
                                'seatType' => $seatClass->name,
                            ];
                        });
                }
            } else {
                $tripPriceList = $trip->route->seatClassesFare
                    ->map(function ($seatClass) {
                        return [
                            'fare' => $seatClass->fare,
                            'color' => $seatClass->color,
                            'currencyCode' => $seatClass->currencyCode ?? 'Ksh',
                            'seatType' => $seatClass->name
                        ];
                    });
            }


            // pickup point
            $pickup_point = $trip->route->pickup_points()
                ->where("pickup_point", $from)->first();

            if ($pickup_point) {
                $pickup_time = $pickup_point->pickup_time;
            }


            $formattedTrip = [
                "trip_id" => $trip->trip_id,
                "average_rating" => $trip->route->bus->average_rating['avg_bus_rating'],
                "bus_type" => $trip->route->bus->bus_type->bus_type,
                "travel_date" => $trip->travel_date,
                "amenities" => $trip->route->bus->amenities->map->only('name', 'icon'),
                "available_seat_count" => $trip->available_seat_count,
                "trip_price_list" => $tripPriceList,
                'pickup_time' => $pickup_time,
                "bus" => [
                    "id" => $trip->route->bus->id,
                    "bus_name" => $trip->route->bus->formatted_name,
                    "images" => $trip->route->bus->images->map->only('url', 'path', 'preview', 'thumbnail')
                ],
                "route" => [
                    "id" => $trip->route->id,
                    "pickup_point" => $trip->route->board_point,
                    "pickup_time" => $trip->route->board_time,
                    "drop_point" => $trip->route->drop_point,
                    "drop_time" => $trip->route->drop_time,
                ],
            ];

            $formattedTrips->push($formattedTrip);
        }

        echo json_encode($formattedTrips);
    }
}
