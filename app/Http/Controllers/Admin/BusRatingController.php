<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusRatingRequest;
use App\Http\Requests\StoreBusRatingRequest;
use App\Http\Requests\UpdateBusRatingRequest;
use App\Models\BusRating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusRatingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busRatings = BusRating::all();

        return view('admin.busRatings.index', compact('busRatings'));
    }

    public function create()
    {
        abort_if(Gate::denies('bus_rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.busRatings.create');
    }

    public function store(StoreBusRatingRequest $request)
    {
        $busRating = BusRating::create($request->all());

        return redirect()->route('admin.bus-ratings.index');
    }

    public function edit(BusRating $busRating)
    {
        abort_if(Gate::denies('bus_rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.busRatings.edit', compact('busRating'));
    }

    public function update(UpdateBusRatingRequest $request, BusRating $busRating)
    {
        $busRating->update($request->all());

        return redirect()->route('admin.bus-ratings.index');
    }

    public function show(BusRating $busRating)
    {
        abort_if(Gate::denies('bus_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.busRatings.show', compact('busRating'));
    }

    public function destroy(BusRating $busRating)
    {
        abort_if(Gate::denies('bus_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busRating->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusRatingRequest $request)
    {
        BusRating::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
