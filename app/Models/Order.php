<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'name',
    'address',
    'phone',
    'items',
    'total_price',
    'status', 
    'payment_method', 
    'bukti_pembayaran'
];

protected $casts = [
    'items' => 'array'
];
    use HasFactory;
}
