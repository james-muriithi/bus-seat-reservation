<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusTypeRequest;
use App\Http\Requests\StoreBusTypeRequest;
use App\Http\Requests\UpdateBusTypeRequest;
use App\Http\Resources\Admin\BusTypeResource;
use App\Models\BusType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bus_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $busTypes = BusType::latest()->get();

        if ($request->ajax()) {
            return new BusTypeResource($busTypes);
        }

        return view('admin.busTypes.index', compact('busTypes'));
    }

    public function store(StoreBusTypeRequest $request)
    {
        $busType = BusType::create($request->all());

        if ($request->ajax()) {
            return (new BusTypeResource($busType))->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.bus-types.index');
    }

    public function update(UpdateBusTypeRequest $request, BusType $busType)
    {
        $busType->update($request->all());

        if ($request->ajax()) {
            return (new BusTypeResource($busType))->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }

        return redirect()->route('admin.bus-types.index');
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
