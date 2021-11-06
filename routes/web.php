<?php


use App\Http\Controllers\Stock\BrandController;
use App\Http\Controllers\Stock\ProductCategoryController;
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

    Route::prefix('category')->group(function (){
        Route::get('/', [ProductCategoryController::class, 'index'])->name('product.category.index');
        Route::get('create', [ProductCategoryController::class, 'create'])->name('product.category.create');
        Route::post('store', [ProductCategoryController::class, 'store'])->name('product.category.store');
        Route::get('edit/{category}', [ProductCategoryController::class, 'edit'])->name('product.category.edit');
        Route::patch('update/{category}', [ProductCategoryController::class, 'update'])->name('product.category.update');
        Route::any('delete/{category}', [ProductCategoryController::class, 'delete'])->name('product.category.delete');
    });

    #============================================ PRODUCT CATEGORY END=================================================#


    #========================================== PRODUCT BRANDS START ==================================================#

    Route::prefix('brand')->group(function (){
        Route::get('/', [BrandController::class, 'index'])->name('product.brands.index');
        Route::get('create', [BrandController::class, 'create'])->name('product.brands.create');
        Route::post('store', [BrandController::class, 'store'])->name('product.brands.store');
        Route::get('edit/{brands}', [BrandController::class, 'edit'])->name('product.brands.edit');
        Route::patch('update/{brands}', [BrandController::class, 'update'])->name('product.brands.update');
        Route::any('delete/{brands}', [BrandController::class, 'delete'])->name('product.brands.delete');
    });

    #============================================ PRODUCT BRANDS END ==================================================#

});


require __DIR__.'/auth.php';
