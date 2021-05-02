<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function findBasedOnCategory(Category $categorySlug)
    {
        $advertisements = $categorySlug->advertisements;
        $filterBySubcategory = Subcategory::where('category_id', $categorySlug->id)->get();

        return view('product.category', compact('advertisements', 'filterBySubcategory'));
    }

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

    public function findBasedOnChildcategory(Request $request, $categorySlug,Subcategory $subcategorySlug,Childcategory $childcategorySlug)
    {
        $advertisementBasedOnFilter = Advertisement::where('childcategory_id', $childcategorySlug->id)
            ->when($request->minPrice, function ($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
            })->when($request->maxPrice, function ($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })->get();

        $advertisementWithoutFilter = $childcategorySlug->advertisements;
        // unique()をつけることで、$subcategorySlugにひもづくadvertisementsの重複しているものが削除される
        $filterByChildcategories = $subcategorySlug->advertisements->unique('childcategory_id');

        $advertisements = $request->minPrice || $request->maxPrice ? $advertisementBasedOnFilter : $advertisementWithoutFilter;

        return view('product.childcategory', compact('advertisements', 'filterByChildcategories'));
    }
}
