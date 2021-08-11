<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySeatLayoutRequest;
use App\Http\Requests\StoreSeatLayoutRequest;
use App\Http\Requests\UpdateSeatLayoutRequest;
use App\Models\Bus;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SeatLayout;

class SeatLayoutController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seat_layout_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seatLayouts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seat_layout_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seatLayouts.create');
    }

    public function store(StoreSeatLayoutRequest $request)
    {
        if ($request->ajax()) {
            $details = $request->input('details');

            $seats = $details['seats'];
            return $seats;
        }

        $bus = Bus::find($request->input('bus_id'));

        $seatLayout = $bus->seat_layout()
            ->updateOrCreate(['bus_id' => $request->input('bus_id')], $request->all());

        $details = $request->input('details');

        $seats = $details['seats'];

        foreach ($seats as $seat) {
            $bus->seats()->
        }


        return redirect()->route('admin.seat-layouts.index');
    }

    public function edit(SeatLayout $seatLayout)
    {
        abort_if(Gate::denies('seat_layout_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seatLayouts.edit', compact('seatLayout'));
    }

    public function update(UpdateSeatLayoutRequest $request, SeatLayout $seatLayout)
    {
        $seatLayout->update($request->all());

        return redirect()->route('admin.seat-layouts.index');
    }

    public function show(SeatLayout $seatLayout)
    {
        abort_if(Gate::denies('seat_layout_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seatLayouts.show', compact('seatLayout'));
    }

    public function destroy(SeatLayout $seatLayout)
    {
        abort_if(Gate::denies('seat_layout_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seatLayout->delete();

        return back();
    }

    public function massDestroy(MassDestroySeatLayoutRequest $request)
    {
        SeatLayout::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
