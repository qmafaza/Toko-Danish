<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRating extends Model
{
    protected $fillable = [
        'rating',
        'rating_description',
        'product_id',
        'user_id'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relasi ke Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke User yang memberi rating
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Rules validasi
     */
    public static function validationRules(): array
    {
        return [
            'rating' => 'required|integer|between:1,5',
            'rating_description' => 'required|string|max:1000',
            'product_id' => 'required|exists:products,id'
        ];
    }

    /**
     * Scope untuk rating produk tertentu
     */
    public function scopeForProduct($query, int $productId)
    {
        return $query->where('product_id', $productId);
    }

    /**
     * Scope untuk rating dengan nilai tertentu
     */
    public function scopeWithRating($query, int $rating)
    {
        return $query->where('rating', $rating);
    }
}