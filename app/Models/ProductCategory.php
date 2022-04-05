<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id');
    }


    public function generateCategoryRoute()
    {
        return route('website.category.index', [mt_rand(11111, 99999), $this->id, Str::slug($this->name)]);
    }
}
