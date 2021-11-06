<?php

use App\Models\ProductCategory;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::group(['middleware' => 'auth', 'prefix' => 'stock'], function (){

    #========================================== PRODUCT CATEGORY START=================================================#

    Route::prefix('product/category')->group(function (){
        Route::get('/', [ProductCategory::class, 'index'])->name('product.category.index');
        Route::get('create', [ProductCategory::class, 'create'])->name('product.category.create');
        Route::post('store', [ProductCategory::class, 'store'])->name('product.category.store');
        Route::get('edit/{category}', [ProductCategory::class, 'edit'])->name('product.category.edit');
        Route::patch('update/{category}', [ProductCategory::class, 'update'])->name('product.category.update');
        Route::get('delete/{category}', [ProductCategory::class, 'delete'])->name('product.category.delete');
    });

    #============================================ PRODUCT CATEGORY END=================================================#

});


require __DIR__.'/auth.php';
