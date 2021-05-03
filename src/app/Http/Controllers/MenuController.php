<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu()
    {
        $category = Category::where('name', 'car')->first();
        $firstAds = Advertisement::where('category_id', $category->id)
            ->orderByDesc('id')->take(4)->get();

        $secondsAds = Advertisement::where('category_id', $category->id)
            ->whereNotIn('id', $firstAds->pluck('id')->toArray())
            ->take(4)->get();

        return view('index', compact('firstAds', 'secondsAds', 'category'));
    }
}
