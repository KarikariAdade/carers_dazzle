<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
