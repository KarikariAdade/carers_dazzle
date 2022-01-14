<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function generateRoute()
    {
        return route('customer.orders.detail', ['order' => $this->id, 'hash' => Str::random(10), 'random' => mt_rand(11111, 99999)]);
    }

    public function getRegion()
    {
        return $this->belongsTo(Regions::class, 'region_id');
    }

    public function getTown()
    {
        return $this->belongsTo(Towns::class, 'town_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
