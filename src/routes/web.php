<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildcategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
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

Route::get('/', [MenuController::class, 'Menu']);

// ads
Route::get('/ads/create', [AdvertisementController::class, 'create'])->middleware('auth');
Route::post('/ads/store', [AdvertisementController::class, 'store'])->middleware('auth')->name('ads.store');
Route::get('/ads', [AdvertisementController::class, 'index'])->middleware('auth');
Route::get('/ads/{id}/edit', [AdvertisementController::class, 'edit'])->middleware('auth')->name('ads.edit');

