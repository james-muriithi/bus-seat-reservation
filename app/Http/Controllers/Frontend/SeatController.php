<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySeatRequest;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Models\Bus;
use App\Models\Seat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeatController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seats = Seat::with(['bus'])->get();

        return view('frontend.seats.index', compact('seats'));
    }

    public function create()
    {
        abort_if(Gate::denies('seat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.seats.create', compact('buses'));
    }

    public function store(StoreSeatRequest $request)
    {
        $seat = Seat::create($request->all());

        return redirect()->route('frontend.seats.index');
    }

    public function edit(Seat $seat)
    {
        abort_if(Gate::denies('seat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buses = Bus::all()->pluck('bus_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seat->load('bus');

        return view('frontend.seats.edit', compact('buses', 'seat'));
    }

    public function update(UpdateSeatRequest $request, Seat $seat)
    {
        $seat->update($request->all());

        return redirect()->route('frontend.seats.index');
    }

    public function show(Seat $seat)
    {
        abort_if(Gate::denies('seat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seat->load('bus');

        return view('frontend.seats.show', compact('seat'));
    }

    public function destroy(Seat $seat)
    {
        abort_if(Gate::denies('seat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seat->delete();

        return back();
    }

    public function massDestroy(MassDestroySeatRequest $request)
    {
        Seat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
