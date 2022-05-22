<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRegion()
    {
        return $this->belongsTo(Countries::class, 'region_id');
    }

    public function getTown()
    {
        return $this->belongsTo(Regions::class, 'town_id');
    }

}
