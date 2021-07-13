<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDropOffPointRequest;
use App\Http\Requests\StoreDropOffPointRequest;
use App\Http\Requests\UpdateDropOffPointRequest;
use App\Models\DropOffPoint;
use App\Models\Route;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DropOffPointController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drop_off_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dropOffPoints = DropOffPoint::with(['route'])->get();

        return view('frontend.dropOffPoints.index', compact('dropOffPoints'));
    }

    public function create()
    {
        abort_if(Gate::denies('drop_off_point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.dropOffPoints.create', compact('routes'));
    }

    public function store(StoreDropOffPointRequest $request)
    {
        $dropOffPoint = DropOffPoint::create($request->all());

        return redirect()->route('frontend.drop-off-points.index');
    }

    public function edit(DropOffPoint $dropOffPoint)
    {
        abort_if(Gate::denies('drop_off_point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $routes = Route::all()->pluck('board_point', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dropOffPoint->load('route');

        return view('frontend.dropOffPoints.edit', compact('routes', 'dropOffPoint'));
    }

    public function update(UpdateDropOffPointRequest $request, DropOffPoint $dropOffPoint)
    {
        $dropOffPoint->update($request->all());

        return redirect()->route('frontend.drop-off-points.index');
    }

    public function show(DropOffPoint $dropOffPoint)
    {
        abort_if(Gate::denies('drop_off_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dropOffPoint->load('route');

        return view('frontend.dropOffPoints.show', compact('dropOffPoint'));
    }

    public function destroy(DropOffPoint $dropOffPoint)
    {
        abort_if(Gate::denies('drop_off_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dropOffPoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyDropOffPointRequest $request)
    {
        DropOffPoint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
