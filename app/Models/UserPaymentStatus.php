<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_id',
        'payment_type',
        'amount',
        'currency',
        'payment_id',
        'payment_status',
        'payment_date',
        'payment_details',
    ];
}
