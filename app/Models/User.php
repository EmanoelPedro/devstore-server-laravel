<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function addToCart(string $productId,int $quantity = 1): false|User
    {
        $product = Product::find($productId);

        if(empty($product)) {
            return false;
        }

        if($this->haveOpenCart() == false) {
            $this->createOpenCart();
        }
        $cart = $this->getOpenCart();


        if($cart->products()->find($product->id) == null) {
            $cart->products()->attach($product->id, ['quantity' => $quantity,'created_at' => now()]);
            return $this;
        }

        $productQuantity = $cart->products()->find($product->id)->pivot->quantity;

        $cart->products()->updateExistingPivot($product->id,['quantity' => $productQuantity + $quantity]);

        return $this;
    }

    public function removeFromCart(string $productId, $quantity = 1): bool|User
    {
        $product = Product::find($productId);

        if(empty($product)) {
            return false;
        }

        if(!$this->haveOpenCart()) {
            return false;
        }

        if($quantity <= 0) {
            return false;
        }

        $cart = $this->getOpenCart();


        if($cart->products()->find($product->id) == null) {
            return false;
        }

        $productQuantity = $cart->products()->find($product->id)->pivot->quantity;


        if($productQuantity <= $quantity) {
            $cart->products()->detach($product->id);
            return true;
        }

        $cart->products()->updateExistingPivot($product->id,['quantity' => $productQuantity - $quantity]);

        return $this;
    }

    /**
     * @return HasOne
     */
    public function address(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function paymentStatus(): HasMany
    {
        return $this->hasMany(UserPaymentStatus::class);
    }
}
