<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoutePriceVariationRequest;
use App\Http\Requests\StoreRoutePriceVariationRequest;
use App\Http\Requests\UpdateRoutePriceVariationRequest;
use App\Http\Resources\Admin\RoutePriceVariationResource;
use App\Models\BusSeatClass;
use App\Models\DropOffPoint;
use App\Models\PickupPoint;
use App\Models\RoutePriceVariation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoutePriceVariationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('route_price_variation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routePriceVariations = RoutePriceVariation::query()
            ->with(['pickup_point', 'drop_point', 'variation_seat_classes', 'route']);

        if ($request->query("route_id")) {
            $routePriceVariations = $routePriceVariations->where('route_id', $request->query('route_id'));
        }

        $routePriceVariations = $routePriceVariations->latest()->get();

        if ($request->ajax()) {
            return new RoutePriceVariationResource($routePriceVariations);
        }

        return view('admin.routePriceVariations.index', compact('routePriceVariations'));
    }

    public function create()
    {
        abort_if(Gate::denies('route_price_variation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickup_points = PickupPoint::pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drop_points = DropOffPoint::pluck('drop_off_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seat_classes = BusSeatClass::pluck('name', 'id');

        return view('admin.routePriceVariations.create', compact('pickup_points', 'drop_points', 'seat_classes'));
    }

    public function store(StoreRoutePriceVariationRequest $request)
    {
        $variationExists = RoutePriceVariation::query()
            ->where('drop_point_id', $request->input('drop_point_id'))
            ->where('pickup_point_id', $request->input('pickup_point_id'))
            ->first();
        if ($variationExists) {
            $routePriceVariation = $variationExists->update($request->all());
        } else {
            $routePriceVariation = new RoutePriceVariation($request->all());
        }


        if (count($request->input('seat_classes', [])) > 0) {
            $routePriceVariation->fare = max($request->input('seat_classes'));
            $routePriceVariation->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $routePriceVariation->variation_seat_classes()->sync($seatClasses);
        } else {
            $routePriceVariation->save();
        }

        if ($request->ajax()) {
            return (new RoutePriceVariationResource($routePriceVariation))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.route-price-variations.index');
    }

    public function edit(RoutePriceVariation $routePriceVariation)
    {
        abort_if(Gate::denies('route_price_variation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickup_points = PickupPoint::pluck('pickup_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drop_points = DropOffPoint::pluck('drop_off_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seat_classes = BusSeatClass::pluck('name', 'id');

        $routePriceVariation->load('pickup_point', 'drop_point', 'variation_seat_classes');

        return view('admin.routePriceVariations.edit', compact('pickup_points', 'drop_points', 'seat_classes', 'routePriceVariation'));
    }

    public function update(UpdateRoutePriceVariationRequest $request, RoutePriceVariation $routePriceVariation)
    {
        $routePriceVariation->update($request->all());

        if (count($request->input('seat_classes', [])) > 0) {
            $routePriceVariation->fare = max($request->input('seat_classes'));
            $routePriceVariation->save();

            $seatClasses = [];

            foreach ($request->input('seat_classes') as $index => $fare) {
                if ($fare) {
                    $seatClasses[$index] = ['fare' => $fare];
                }
            }

            $routePriceVariation->variation_seat_classes()->sync($seatClasses);
        } else {
            $routePriceVariation->variation_seat_classes()->sync([]);
        }

        return redirect()->route('admin.route-price-variations.index');
    }

    public function show(RoutePriceVariation $routePriceVariation)
    {
        abort_if(Gate::denies('route_price_variation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routePriceVariation->load('pickup_point', 'drop_point', 'variation_seat_classes');

        return view('admin.routePriceVariations.show', compact('routePriceVariation'));
    }

    public function destroy(RoutePriceVariation $routePriceVariation)
    {
        abort_if(Gate::denies('route_price_variation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routePriceVariation->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoutePriceVariationRequest $request)
    {
        RoutePriceVariation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
