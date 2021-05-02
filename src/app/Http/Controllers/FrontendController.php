<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function findBasedOnSubcategory($categorySlug,Subcategory $subcategorySlug)
    {
        $advertisements = $subcategorySlug->advertisements;
        // unique()をつけることで、$subcategorySlugにひもづくadvertisementsの重複しているものが削除される
        $filterByChildcategories = $subcategorySlug->advertisements->unique('childcategory_id');
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
