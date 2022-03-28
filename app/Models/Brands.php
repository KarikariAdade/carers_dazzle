<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brands extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function getProducts()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function generateBrandRoute()
    {
        return route('website.brand.index', [mt_rand(11111, 99999), $this->id, Str::slug($this->name)]);
    }
}
