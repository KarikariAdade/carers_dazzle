<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Susu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getSusuItems()
    {
        return $this->hasMany(SusuItem::class, 'susu_id');
    }
}
