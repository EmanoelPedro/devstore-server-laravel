<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'address',
        'postal_code',
        'phone',
        'details',
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
