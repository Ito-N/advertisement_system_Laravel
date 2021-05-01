<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getCountry()
    {
        $country = Country::get();
        return response()->json($country);
    }

    public function getState(Request $request)
    {
        $state = State::where('country_id', $request->country_id)->get();
        return response()->json($state);
    }

    public function getCity(Request $request)
    {
        $city = City::where('state_id', $request->state_id)->get();
        return response()->json($city);
    }
}
