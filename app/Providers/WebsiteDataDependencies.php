<?php

namespace App\Providers;

use App\Models\Brands;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

class WebsiteDataDependencies extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(['layouts.website', 'layouts.pages', 'home'], function ($view) {

            $categories = ProductCategory::query()->orderBy('id', 'DESC')->get();

            $brands = Brands::query()->orderBy('id', 'DESC')->get();

            $carts = Cart::content();

            $wishlist = 0;

            if(auth()->guard('web')->check()){
                $wishlist = Wishlist::query()->where('user_id', auth()->guard('web')->user()->id)->count();
            }



            $view->with([
                'categories' => $categories,
                'brands' => $brands,
                'carts' => $carts,
                'wishlist' => $wishlist
            ]);
        });

    }
}
