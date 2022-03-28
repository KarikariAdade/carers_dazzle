<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusuItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getSusu(){
        return $this->belongsTo(Susu::class, 'susu_id');
    }
}
