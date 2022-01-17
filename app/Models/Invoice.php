<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function generateRoute()
    {
        return route('customer.invoices.detail', ['invoice' => $this->id, 'hash' => Str::random(10), 'random' => mt_rand(11111, 99999)]);
    }

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function generatePrintRoute()
    {
        return route('customer.invoices.print', ['invoice' => $this->id, 'hash' => Str::random(10), 'random' => mt_rand(11111, 99999)]);
    }
}
