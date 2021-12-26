<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getProducts()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
