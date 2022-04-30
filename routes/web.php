<?php


use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Customers\DashboardController;
use App\Http\Controllers\Sales\InvoiceController;
use App\Http\Controllers\Sales\OrderController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Sales\SusuController;
use App\Http\Controllers\Stock\BrandController;
use App\Http\Controllers\Stock\CouponsController;
use App\Http\Controllers\Stock\CustomersController;
use App\Http\Controllers\Stock\ProductCategoryController;
use App\Http\Controllers\Stock\ProductController;
use App\Http\Controllers\Stock\PromotionalBannerController;
use App\Http\Controllers\Stock\ShippingController;
use App\Http\Controllers\Stock\SubCategoryController;
use App\Http\Controllers\Stock\TaxController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\FilterController;
use App\Http\Controllers\Website\HomepageController;
use App\Http\Controllers\Website\PagesController;
use App\Http\Controllers\Website\ReviewsController;
use App\Http\Controllers\Website\WishlistController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//Route::get('/', function () {
//    return view('home');
//})->name('website.home');


Route::get('/', [PagesController::class, 'home'])->name('website.home');

Route::get('category/{random}/{category}/{name}', [PagesController::class, 'category'])->name('website.category.index');

Route::get('brand/{random}/{brand}/{name}', [PagesController::class, 'brand'])->name('website.brand.index');

Route::get('product/{product}/{name}/{hash}', [PagesController::class, 'productDetail'])->name('website.product.detail');

Route::get('shop', [PagesController::class, 'shop'])->name('website.shop.index');

Route::post('client/register', [AuthController::class, 'register'])->name('website.client.register');

Route::post('client/login/post', [AuthController::class, 'loginUser'])->name('website.client.login.post');

Route::any('currency/convert/{selected}', [Controller::class, 'convertCurrency'])->name('website.currency.convert');

Route::any('payment/callback', [CheckoutController::class, 'callback'])->name('website.checkout.payment.callback');

Route::get('contact', [PagesController::class, 'contact'])->name('website.contact.index');


Route::get('payment/status', [CheckoutController::class, 'status'])->name('website.checkout.payment.status');

Route::get('order/delivery/{order}/success', [CheckoutController::class, 'payOnDelivery'])->name('website.checkout.payment.delivery');

Route::any('shop/filter', [FilterController::class, 'index'])->name('website.filter.index');






#=========================================  WEBSITE ROUTES ==================================================#
//
//Route::get('/', [HomepageController::class, 'index'])->name('website.index');
//
Route::prefix('shop')->group(function(){
//    Route::get('brand/{brand}', [HomepageController::class, 'brand'])->name('website.brand');
//    Route::get('category/{category}', [HomepageController::class, 'categories'])->name('website.category');
//    Route::get('/', [HomepageController::class, 'shops'])->name('website.shop');
//    Route::get('product/{product}/{name}/{hash}', [HomepageController::class, 'shopDetail'])->name('website.shop.detail');

    Route::prefix('cart')->group(function (){
        Route::get('/', [CartController::class, 'index'])->name('website.cart.index');
        Route::any('add/{product}', [CartController::class, 'addToCart'])->name('website.cart.add');
        Route::any('item/{row}/remove', [CartController::class, 'removeFromCart'])->name('website.cart.remove');
        Route::post('update', [CartController::class, 'updateCart'])->name('website.cart.update');
        Route::post('coupon/add', [CartController::class, 'addCoupon'])->name('website.cart.coupon.add');
        Route::any('clear', [CartController::class, 'clearCart'])->name('website.cart.clear');
        Route::post('calculate/shipping', [CartController::class, 'calculateShipping'])->name('website.cart.shipping.calculate');
    });

    Route::prefix('checkout')->group(function (){
        Route::get('/', [CheckoutController::class, 'index'])->name('website.checkout.index');
        Route::post('customer/login', [CheckoutController::class, 'customerLogin'])->name('website.checkout.customer.login');
        Route::post('order', [CheckoutController::class, 'order'])->name('website.checkout.order');
    });


    Route::prefix('review')->group(function (){
        Route::get('add', [ReviewsController::class, 'add'])->name('website.review.add');
    });
});


//
//Route::get('admin/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');



Route::group(['prefix' => 'admin'], function () {


    Route::get('getProducts', [SusuController::class, 'fetchProducts'])->name('admin.fetch.products');



    Route::get('auth/login/index', [AdminAuthController::class, 'index'])->name('admin.auth.login.index');
    Route::post('auth/login', [AdminAuthController::class, 'login'])->name('admin.auth.login');
    Route::get('auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');
    Route::post('get/towns', [ShippingController::class, 'getTowns'])->name('product.shipping.get.town');

    Route::group(['middleware' => 'auth:admin'], function (){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('update/phone', [AdminDashboardController::class, 'updatePhone'])->name('admin.dashboard.update.phone');


    Route::prefix('stock')->group(function (){

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
        Route::any('mark/featured/{product}/{type}/{origin}', [ProductController::class, 'markFeatured'])->name('product.mark.featured');
        Route::any('mark/hot/{product}/{type}/{origin}', [ProductController::class, 'markHot'])->name('product.mark.hot');
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

    Route::prefix('shipping')->group(function (){
        Route::get('/', [ShippingController::class, 'index'])->name('product.shipping.index');
        Route::post('store', [ShippingController::class, 'store'])->name('product.shipping.store');
        Route::get('edit/{shipping}', [ShippingController::class, 'edit'])->name('product.shipping.edit');
        Route::post('update/{shipping}', [ShippingController::class, 'update'])->name('product.shipping.update');
        Route::any('delete/{shipping}', [ShippingController::class, 'delete'])->name('product.shipping.delete');
        Route::any('set/default/{shipping}', [ShippingController::class, 'setDefault'])->name('product.shipping.set.default');
    });

    Route::prefix('promotional/banner')->group(function () {
        Route::get('/', [PromotionalBannerController::class, 'index'])->name('product.banner.index');
        Route::post('store', [PromotionalBannerController::class, 'store'])->name('product.banner.store');
        Route::post('update/{banner}', [PromotionalBannerController::class, 'update'])->name('product.banner.update');
        Route::get('edit/{banner}', [PromotionalBannerController::class, 'edit'])->name('product.banner.edit');
        Route::any('delete/{banner}', [PromotionalBannerController::class, 'delete'])->name('product.banner.delete');
        Route::any('featured/mark/{banner}/{type}/{origin}', [PromotionalBannerController::class, 'markFeatured'])->name('product.banner.mark.featured');
        Route::get('details/{banner}', [PromotionalBannerController::class, 'details'])->name('product.banner.details');
        Route::any('mark/active/{banner}/{type}/{origin}', [PromotionalBannerController::class, 'markActive'])->name('product.banner.mark.active');
    });

    });


    Route::prefix('sales/management')->group(function (){

        Route::prefix('customer')->group(function (){
            Route::get('/', [CustomersController::class, 'index'])->name('sales.customer.index');
            Route::post('store', [CustomersController::class, 'store'])->name('sales.customer.store');
            Route::get('details/{customer}', [CustomersController::class, 'details'])->name('sales.customer.details');
            Route::patch('update/{customer}', [CustomersController::class, 'update'])->name('sales.customer.update');
            Route::any('delete/{customer}', [CustomersController::class, 'delete'])->name('sales.customer.delete');
        });


        Route::prefix('invoice')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
            Route::get('create', [InvoiceController::class, 'create'])->name('invoice.create');
            Route::post('store', [InvoiceController::class, 'store'])->name('invoice.store');
            Route::get('edit/{invoice}', [InvoiceController::class, 'edit'])->name('invoice.edit');
            Route::get('details/{invoice}', [InvoiceController::class, 'details'])->name('invoice.details');
            Route::post('update/{invoice}', [InvoiceController::class, 'update'])->name('invoice.update');
            Route::any('delete/{invoice}', [InvoiceController::class, 'delete'])->name('invoice.delete');
            Route::any('get/invoice/item/{invoice}', [InvoiceController::class, 'fetchInvoiceItems'])->name('invoice.get.items');
            Route::post('payment/verify/{invoice}', [InvoiceController::class, 'verifyPayment'])->name('invoice.verify.payment');
        });

        Route::prefix('daily/sales')->group(function (){
            Route::get('/', [SalesController::class, 'index'])->name('sales.daily.index');
        });


        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('sales.order.index');
            Route::get('{order}/details', [OrderController::class, 'details'])->name('sales.order.details');
        });



        Route::prefix('susu')->group(function (){
            Route::get('/', [SusuController::class, 'index'])->name('sales.susu.index');
            Route::get('create', [SusuController::class, 'create'])->name('sales.susu.create');
            Route::post('store', [SusuController::class, 'store'])->name('sales.susu.store');
            Route::get('edit/{susu}', [SusuController::class, 'edit'])->name('sales.susu.edit');
            Route::post('update/{susu}', [SusuController::class, 'update'])->name('sales.susu.update');
        });
    });

});
});



Route::group(['middleware' => 'auth:web', 'prefix' => 'customer/dashboard'], function (){

    Route::get('/', [DashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('orders', [DashboardController::class, 'orders'])->name('customer.orders');
    Route::get('orders/{order}/{hash}/{random}', [DashboardController::class, 'orderDetail'])->name('customer.orders.detail');

    Route::prefix('invoice')->group(function (){
        Route::get('/', [DashboardController::class, 'invoices'])->name('customer.invoices');
        Route::get('{invoice}/{hash}/{random}', [DashboardController::class, 'invoiceDetail'])->name('customer.invoices.detail');
        Route::get('{invoice}/{hash}/{random}/print', [DashboardController::class, 'printInvoice'])->name('customer.invoices.print');
    });

    Route::prefix('account')->group(function (){
        Route::get('/', [DashboardController::class, 'accountDetails'])->name('customer.account.index');
        Route::post('update', [DashboardController::class, 'updateAccountDetails'])->name('customer.account.update');
    });

    Route::prefix('reviews')->group(function (){
        Route::post('submit/{product}', [ReviewsController::class, 'addReview'])->name('customer.review.store');

    });

    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('customer.wishlist.index');
        Route::any('store/{product}', [WishlistController::class, 'store'])->name('customer.wishlist.store');
        Route::get('remove/{wishlist}', [WishlistController::class, 'remove'])->name('customer.wishlist.remove');
    });

});
