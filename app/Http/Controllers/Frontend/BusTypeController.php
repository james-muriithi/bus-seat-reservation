<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusTypeRequest;
use App\Http\Requests\StoreBusTypeRequest;
use App\Http\Requests\UpdateBusTypeRequest;
use App\Models\BusType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bus_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busTypes = BusType::all();

        return view('frontend.busTypes.index', compact('busTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('bus_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busTypes.create');
    }

    public function store(StoreBusTypeRequest $request)
    {
        $busType = BusType::create($request->all());

        return redirect()->route('frontend.bus-types.index');
    }

    public function edit(BusType $busType)
    {
        abort_if(Gate::denies('bus_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busTypes.edit', compact('busType'));
    }

    public function update(UpdateBusTypeRequest $request, BusType $busType)
    {
        $busType->update($request->all());

        return redirect()->route('frontend.bus-types.index');
    }

    public function show(BusType $busType)
    {
        abort_if(Gate::denies('bus_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.busTypes.show', compact('busType'));
    }

    public function destroy(BusType $busType)
    {
        abort_if(Gate::denies('bus_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusTypeRequest $request)
    {
        BusType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
