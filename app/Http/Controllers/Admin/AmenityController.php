<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAmenityRequest;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Http\Resources\Admin\AmenityResource;
use App\Models\Amenity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::latest()->get();

        if ($request->ajax()) {
            return new AmenityResource($amenities);
        }

        return view('admin.amenities.index', compact('amenities'));
    }

    public function store(StoreAmenityRequest $request)
    {
        $amenity = Amenity::create($request->all());

        if ($request->ajax()) {
            return (new AmenityResource($amenity))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->route('admin.amenities.index');
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $amenity->update($request->all());

        return redirect()->route('admin.amenities.index');
    }

    public function destroy(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyAmenityRequest $request)
    {
        Amenity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
