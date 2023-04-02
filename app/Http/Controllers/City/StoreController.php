<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreRequest;
use App\Models\City;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $city = City::create([
            'name' => $request->get('city')
        ]);

        return response()->json(['data' => $city]);
    }
}
