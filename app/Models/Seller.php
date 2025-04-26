<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Seller extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'store_name',
        'contact_person',
        'contact_number',
        'email',
        'seller_address',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
