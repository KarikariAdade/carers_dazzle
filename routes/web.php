<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Website\PagesController;
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
    return view('home');
})->name('website.home');

#========================================= WEBSITE ROUTES ======================================#

Route::get('category', [PagesController::class, 'category'])->name('website.category.index');
Route::get('brand', [PagesController::class, 'brand'])->name('website.brand.index');
Route::get('product/detail', [PagesController::class, 'productDetail'])->name('website.product.detail');
Route::get('shop', [PagesController::class, 'shop'])->name('website.shop.index');
Route::get('contact', [PagesController::class, 'contact'])->name('website.contact.index');



Route::prefix('account')->group(function (){
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('account.dashboard.index');
});
