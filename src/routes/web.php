<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildcategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontAdsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::get('/auth', function () {
    return view('backend.admin.index');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

// admin
Route::group(['prefix' => 'auth'], function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/subcategory', SubcategoryController::class);
    Route::resource('/childcategory', ChildcategoryController::class);
});

Route::get('/', [FrontAdsController::class, 'index']);

// ads
Route::get('/ads/create', [AdvertisementController::class, 'create'])->middleware('auth')->name('ads.create');
Route::post('/ads/store', [AdvertisementController::class, 'store'])->middleware('auth')->name('ads.store');
Route::get('/ads', [AdvertisementController::class, 'index'])->middleware('auth')->name('ads.index');
Route::get('/ads/{id}/edit', [AdvertisementController::class, 'edit'])->middleware('auth')->name('ads.edit');
Route::put('/ads/{id}/update', [AdvertisementController::class, 'update'])->middleware('auth')->name('ads.update');
Route::delete('/ads/{id}/delete', [AdvertisementController::class, 'destroy'])->middleware('auth')->name('ads.destroy');

// profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('update.profile')->middleware('auth');

// frontend
Route::get('/product/{categorySlug}', [FrontendController::class, 'findBasedOnCategory'])->name('category.show');
Route::get('/product/{categorySlug}/{subcategorySlug}', [FrontendController::class, 'findBasedOnSubcategory'])->name('subcategory.show');
Route::get('/product/{categorySlug}/{subcategorySlug}/{childcategorySlug}', [FrontendController::class, 'findBasedOnChildcategory'])->name('childcategory.show');
Route::get('/products/{id}/{slug}', [FrontendController::class, 'show'])->name('product.view');
