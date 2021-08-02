<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRouteRequest;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Http\Resources\Admin\RouteResource;
use App\Models\Bus;
use App\Models\DropOffPoint;
use App\Models\PickupPoint;
use App\Models\Route;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('route_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::with(['bus', 'route_seat_classes'])->latest()->get();

        if ($request->ajax()) {
            return new RouteResource($routes);
        }

        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        abort_if(Gate::denies('route_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.routes.create', compact('buses'));
    }

    public function store(StoreRouteRequest $request)
    {
        $bus = Bus::find($request->input('bus_id'));
        $routeExists = $bus->routes()
            ->where('drop_point', $request->input('drop_point'))
            ->where('board_point', $request->input('board_point'))
            ->first();
        if ($routeExists) {
            return "";
        }

        $route = new Route($request->all());

        if (count($request->input('seat_classes', [])) > 0) {
            $route->fare = max($request->input('seat_classes'));
            $route->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $route->route_seat_classes()->sync($seatClasses);
        } else {
            $route->save();
        }

        //create dropoff point
        DropOffPoint::create([
            'drop_off_point' => $request->input('drop_point'),
            'drop_time' => $request->input('drop_time'),
            'route_id' => $route->id,
        ]);
        //create board point
        PickupPoint::create([
            'pickup_point' => $request->input('board_point'),
            'pickup_time' => $request->input('board_time'),
            'status' => 1,
            'route_id' => $route->id,
        ]);

        if ($request->ajax()) {
            return (new RouteResource($route))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.routes.index');
    }

    public function edit(Route $route)
    {
        abort_if(Gate::denies('route_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $route->load('bus');

        return view('admin.routes.edit', compact('buses', 'route'));
    }

    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route->update($request->all());

        if (count($request->input('seat_classes', [])) > 0) {
            $route->fare = max($request->input('seat_classes'));
            $route->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $route->route_seat_classes()->sync($seatClasses);
        }
        //update dropoff
        $dropOff = $route->drop_off_points()
            ->latest()
            ->get()
            ->last();
        $dropOff->drop_off_point = $request->input('drop_point');
        $dropOff->save();

        //update pickup
        $pickup = $route->pickup_points()
            ->latest()
            ->get()
            ->last();
        $pickup->pickup_point = $request->input('board_point');
        $pickup->save();

        if ($request->ajax()) {
            return (new RouteResource($route))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }

        return redirect()->route('admin.routes.index');
    }

    public function show(Route $route)
    {
        abort_if(Gate::denies('route_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $route->load('bus');

        return view('admin.routes.show', compact('route'));
    }

    public function destroy(Route $route)
    {
        abort_if(Gate::denies('route_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $route->delete();

        return back();
    }

    public function massDestroy(MassDestroyRouteRequest $request)
    {
        Route::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
