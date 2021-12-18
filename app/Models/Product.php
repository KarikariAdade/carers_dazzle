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
}
