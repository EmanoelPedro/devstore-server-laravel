<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'carts_products','cart_id','product_id','id','id')->withPivot('quantity');
    }

    public function getTotalValue(): float|int
    {
     $products = $this->products()->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }
        return $total;
    }
}
