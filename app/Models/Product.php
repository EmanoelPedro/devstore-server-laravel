<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,"products_categories","product_id","category_id");
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class,'product_id');
    }
}
