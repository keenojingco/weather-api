<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $cities = City::all();

        return response()->json([
            'data' => $cities,
        ]);
    }
}
