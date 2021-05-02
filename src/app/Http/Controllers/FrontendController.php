<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function findBasedOnSubcategory(Request $request, $categorySlug,Subcategory $subcategorySlug)
    {
        $advertisementBasedOnFilter = Advertisement::where('subcategory_id', $subcategorySlug->id)
            ->when($request->minPrice, function ($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
            })->when($request->maxPrice, function ($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })->get();

        $advertisementWithoutFilter = $subcategorySlug->advertisements;
        // unique()をつけることで、$subcategorySlugにひもづくadvertisementsの重複しているものが削除される
        $filterByChildcategories = $subcategorySlug->advertisements->unique('childcategory_id');

        $advertisements = $request->minPrice || $request->maxPrice ? $advertisementBasedOnFilter : $advertisementWithoutFilter;

        return view('product.subcategory', compact('advertisements', 'filterByChildcategories'));
    }

    public function findBasedOnChildcategory($categorySlug,Subcategory $subcategorySlug,Childcategory $childcategorySlug)
    {
        $advertisements = $childcategorySlug->advertisements;
        // unique()をつけることで、$subcategorySlugにひもづくadvertisementsの重複しているものが削除される
        $filterByChildcategories = $subcategorySlug->advertisements->unique('childcategory_id');

        return view('product.childcategory', compact('advertisements', 'filterByChildcategories'));
    }
}
