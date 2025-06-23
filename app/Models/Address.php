<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'is_primary',
        'name',
        'address',
        'phone',
        'city',
        'province',
        'postcode'
    ];

    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}