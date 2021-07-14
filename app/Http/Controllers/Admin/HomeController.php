<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                "message" => "hello there"
            ]);
        }

        return view('home');
    }
}
