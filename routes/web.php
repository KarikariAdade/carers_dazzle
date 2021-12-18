<?php


use App\Http\Controllers\Stock\BrandController;
use App\Http\Controllers\Stock\CouponsController;
use App\Http\Controllers\Stock\ProductCategoryController;
use App\Http\Controllers\Stock\ProductController;
use App\Http\Controllers\Stock\SubCategoryController;
use App\Http\Controllers\Stock\TaxController;
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


    #========================================== PRODUCT SHELF START ===================================================#

    Route::prefix('sub_category')->group(function (){
        Route::get('/', [SubCategoryController::class, 'index'])->name('product.sub_category.index');
        Route::get('create', [SubCategoryController::class, 'create'])->name('product.sub_category.create');
        Route::post('store', [SubCategoryController::class, 'store'])->name('product.sub_category.store');
        Route::get('edit/{sub_category}', [SubCategoryController::class, 'edit'])->name('product.sub_category.edit');
        Route::patch('update/{sub_category}', [SubCategoryController::class, 'update'])->name('product.sub_category.update');
        Route::any('delete/{sub_category}', [SubCategoryController::class, 'delete'])->name('product.sub_category.delete');
    });

    #========================================== PRODUCT SHELF END =====================================================#


    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('details/{product}', [ProductController::class, 'details'])->name('product.details');
        Route::patch('update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::any('delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
        Route::any('delete/product/picture/{picture}', [ProductController::class, 'deleteProductPicture'])->name('product.delete.picture');
    });


    Route::prefix('coupon')->group(function (){
        Route::get('/', [CouponsController::class, 'index'])->name('product.coupon.index');
        Route::post('store', [CouponsController::class, 'store'])->name('product.coupon.store');
        Route::post('{coupon}/update', [CouponsController::class, 'update'])->name('product.coupon.update');
        Route::any('delete/{coupon}', [CouponsController::class, 'delete'])->name('product.coupon.delete');
    });

    Route::prefix('tax')->group(function (){
        Route::get('/', [TaxController::class, 'index'])->name('product.tax.index');
        Route::post('store', [TaxController::class, 'store'])->name('product.tax.store');
        Route::patch('update/{tax}', [TaxController::class, 'update'])->name('product.tax.update');
        Route::any('delete/{tax}', [TaxController::class, 'delete'])->name('product.tax.delete');
    });

});


require __DIR__.'/auth.php';
