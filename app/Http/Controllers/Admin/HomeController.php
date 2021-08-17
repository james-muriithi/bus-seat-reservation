<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use App\Models\Passenger;
use App\Models\Route;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $buses = Bus::all()->pluck('id');
            $routes = Route::all()->pluck('id');
            $passengers = Passenger::all()->pluck('id');

            return response()->json([
                "blocks" => [
                    [
                        "title" => "Buses",
                        "number" => $buses->count(),
                        "icon" => '<i class="fa fa-bus"></i>'
                    ],
                    [
                        "title" => "Passengers",
                        "number" => $passengers->count(),
                        "icon" => '<i class="fa fa-users"></i>'
                    ],
                    [
                        "title" => "Routes",
                        "number" => $routes->count(),
                        "icon" => '<i class="ti-vector"></i>'
                    ],
                ],
                "message" => "hello there"
            ]);
        }

        return view('home');
    }
}
