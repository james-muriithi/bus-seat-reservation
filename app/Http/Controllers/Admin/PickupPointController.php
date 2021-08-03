<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPickupPointRequest;
use App\Http\Requests\StorePickupPointRequest;
use App\Http\Requests\UpdatePickupPointRequest;
use App\Http\Resources\Admin\PickupPointResource;
use App\Models\PickupPoint;
use App\Models\Route;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PickupPointController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('pickup_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickupPoints = PickupPoint::with(['route']);

        if ($request->query('route', null)) {
            $pickupPoints = $pickupPoints->where('route_id', $request->query('route'));
        }

        $pickupPoints = $pickupPoints->latest()->get();

        if ($request->ajax()) {
            return new PickupPointResource($pickupPoints);
        }

        return view('admin.pickupPoints.index', compact('pickupPoints'));
    }

    public function create()
    {
        abort_if(Gate::denies('pickup_point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pickupPoints.create', compact('routes'));
    }

    public function store(StorePickupPointRequest $request)
    {
        $pickupPoint = PickupPoint::create($request->all());

        return redirect()->route('admin.pickup-points.index');
    }

    public function edit(PickupPoint $pickupPoint)
    {
        abort_if(Gate::denies('pickup_point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pickupPoint->load('route');

        return view('admin.pickupPoints.edit', compact('routes', 'pickupPoint'));
    }

    public function update(UpdatePickupPointRequest $request, PickupPoint $pickupPoint)
    {
        $pickupPoint->update($request->all());

        if ($request->ajax()) {
            return (new PickupPointResource($pickupPoint))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }

        return redirect()->route('admin.pickup-points.index');
    }

    public function show(PickupPoint $pickupPoint)
    {
        abort_if(Gate::denies('pickup_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickupPoint->load('route');

        return view('admin.pickupPoints.show', compact('pickupPoint'));
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        abort_if(Gate::denies('pickup_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickupPoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyPickupPointRequest $request)
    {
        PickupPoint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
