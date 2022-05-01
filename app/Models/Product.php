<?php

namespace App\Models;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use willvincent\Rateable\Rateable;

class Product extends Model implements Buyable
{
    use HasFactory, Rateable;

    protected $guarded = ['id'];

    public function getBuyableIdentifier($options = null){
        return $this->id;
    }

    public function getBuyableDescription($options = null){
        return $this->name;
    }

    public function getBuyablePrice($options = null){
        return $this->price;
    }

    public function getBrand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }


    public function getCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }


    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'shelf_id');
    }


    public function getPicture()
    {
        return $this->hasMany(ProductPicture::class, 'product_id');
    }


    public function getTaxes()
    {
        return $this->hasMany(Taxes::class, 'id');
    }


    public function generateRoute()
    {
        return route('website.product.detail', [$this->id, strtolower(str_replace(' ', '_', $this->name)), Str::random(10)]);
    }

    public function getSingleImage()
    {
        $image = ProductPicture::query()->where('product_id', $this->id)->first();

        return $image->path ?? null;

    }

    public function getLastImage()
    {
        $image = ProductPicture::query()->where('product_id', $this->id)->orderBy('id', 'DESC')->first();

        return $image->path ?? null;
    }

    public function generateCartRoute()
    {
        return route('website.cart.add', $this->id);
    }


    public function getReviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function convertCurrency()
    {

        if (!empty(session()->get('from_currency')) && !empty(session()->get('to_currency'))){
            $amount = Currency::convert()
                ->from(session()->get('from_currency'))
                ->to(session()->get('to_currency'))
                ->amount($this->price)
                ->get();

            return session()->get('sign').' '.number_format($amount, 2);
        }

        return 'GHS '.number_format($this->price, 2);


    }


}
