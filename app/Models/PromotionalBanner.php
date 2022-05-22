<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalBanner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function getProducts()
    {
        $products = json_decode($this->product_id, true);

        $product_collection = collect();

        foreach ($products as $product){

            $product = Product::query()->where('id', $product)->select(['id', 'name'])->first();

            $product_collection->push($product);
        }


        return $product_collection;
    }
}
