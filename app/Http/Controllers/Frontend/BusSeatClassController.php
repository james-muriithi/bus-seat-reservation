<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusSeatClassRequest;
use App\Http\Requests\StoreBusSeatClassRequest;
use App\Http\Requests\UpdateBusSeatClassRequest;
use App\Models\BusSeatClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusSeatClassController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_seat_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busSeatClasses = BusSeatClass::all();

        return view('frontend.busSeatClasses.index', compact('busSeatClasses'));
    }

    public function create()
    {
        abort_if(Gate::denies('bus_seat_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busSeatClasses.create');
    }

    public function store(StoreBusSeatClassRequest $request)
    {
        $busSeatClass = BusSeatClass::create($request->all());

        return redirect()->route('frontend.bus-seat-classes.index');
    }

    public function edit(BusSeatClass $busSeatClass)
    {
        abort_if(Gate::denies('bus_seat_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busSeatClasses.edit', compact('busSeatClass'));
    }

    public function update(UpdateBusSeatClassRequest $request, BusSeatClass $busSeatClass)
    {
        $busSeatClass->update($request->all());

        return redirect()->route('frontend.bus-seat-classes.index');
    }

    public function show(BusSeatClass $busSeatClass)
    {
        abort_if(Gate::denies('bus_seat_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busSeatClasses.show', compact('busSeatClass'));
    }

    public function destroy(BusSeatClass $busSeatClass)
    {
        abort_if(Gate::denies('bus_seat_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busSeatClass->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusSeatClassRequest $request)
    {
        BusSeatClass::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
