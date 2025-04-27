<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'stock',
        'product_price',
        'product_image',
        'category_id',
        'seller_id'
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    
}
