<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    //

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
