<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function shop()
    {
        return view('website.shop.index');
    }


    public function category()
    {
        return view('website.category.index');
    }

    public function brand()
    {
        return view('website.brand.index');
    }

    public function productDetail()
    {
        return view('website.shop.detail');
    }

    public function contact()
    {
        return view('website.contact.index');
    }
}
