<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
