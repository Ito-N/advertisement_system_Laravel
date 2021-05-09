<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class SaveAdController extends Controller
{
    public function saveAd(Request $request)
    {
        $ad = Advertisement::find($request->adId);
        $ad->userads()->syncWithOutDetaching($request->userId);
    }
}
