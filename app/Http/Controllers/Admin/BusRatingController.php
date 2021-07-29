<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusRatingRequest;
use App\Http\Requests\StoreBusRatingRequest;
use App\Http\Requests\UpdateBusRatingRequest;
use App\Http\Resources\Admin\BusRatingResource;
use App\Models\BusRating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusRatingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bus_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busRatings = BusRating::latest()->get();

        if ($request->ajax()) {
            return new BusRatingResource($busRatings);
        }

        return view('admin.busRatings.index', compact('busRatings'));
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
