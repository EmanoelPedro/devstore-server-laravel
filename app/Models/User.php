<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function carts(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function haveOpenCart(): bool
    {
        return $this->carts()->where('status','=','open')->exists();
    }

    public function createOpenCart(): false|Cart
    {
        if($this->carts()->where('status','=','open')->exists() == true) {
            return false;
        }

       return $this->carts()->create([
            'user_id' => $this->id,
            'status' => 'open'
        ]);
    }

    public function getOpenCart(): ?Cart
    {
        if($this->carts()->where('status','=','open')->exists() == true){
            return $this->carts()->where('status','=','open')->first();
        }
        return null;
    }

    public function addToCart(string $productId)
    {
        $product = Product::find($productId);
        
        if(empty($product)) {
            return false;
        }

        if($this->haveOpenCart() == false) {
            $this->createOpenCart();
        }
        $cart = $this->getOpenCart();
        var_dump($cart->id);
        $products = $cart->products();
        // dd($cart->id);
        var_dump($products->getQuery());
        foreach($products as $product) {
            var_dump($product);
        }
    }
}