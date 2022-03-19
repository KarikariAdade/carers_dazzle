<?php

namespace App\Providers;

use App\Models\Brands;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        view()->composer(['layouts.website', 'layouts.pages'], function ($view) {
            $categories = ProductCategory::query()->orderBy('id', 'DESC')->get();

            $brands = Brands::query()->orderBy('id', 'DESC')->get();

            $view->with([
                'categories' => $categories,
                'brands' => $brands
            ]);
        });



//        return View::share([
//            'categories' => $categories,
////            'brands' => $brands
//        ]);
    }
}
