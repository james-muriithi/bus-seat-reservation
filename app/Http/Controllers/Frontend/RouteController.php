<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRouteRequest;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Bus;
use App\Models\Route;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('route_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::with(['bus'])->get();

        return view('frontend.routes.index', compact('routes'));
    }

    public function create()
    {
        abort_if(Gate::denies('route_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.routes.create', compact('buses'));
    }

    public function store(StoreRouteRequest $request)
    {
        $route = Route::create($request->all());

        return redirect()->route('frontend.routes.index');
    }

    public function edit(Route $route)
    {
        abort_if(Gate::denies('route_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $route->load('bus');

        return view('frontend.routes.edit', compact('buses', 'route'));
    }

    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route->update($request->all());

        return redirect()->route('frontend.routes.index');
    }

    public function show(Route $route)
    {
        abort_if(Gate::denies('route_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $route->load('bus');

        return view('frontend.routes.show', compact('route'));
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
