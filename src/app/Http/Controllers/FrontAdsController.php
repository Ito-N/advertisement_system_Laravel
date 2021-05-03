<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontAdsController extends Controller
{
    public function index()
    {
        $category = Category::categoryCar();
        $firstAds = Advertisement::firstFourAdsInCaurosel($category->id);
        $secondsAds = Advertisement::secondFourAdsInCaurosel($category->id);

        $categoryElectronic = Category::categoryElectronic();
        $firstAdsForElectronics = Advertisement::firstFourAdsInCauroselForElectronic($categoryElectronic->id);
        $secondsAdsForElectronics = Advertisement::secondFourAdsInCauroselForElectronic($categoryElectronic->id);

        return view('index', compact('category', 'firstAds', 'secondsAds', 'categoryElectronic', 'firstAdsForElectronics', 'secondsAdsForElectronics'));
    }
}
