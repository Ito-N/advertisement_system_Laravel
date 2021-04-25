<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildcategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

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
