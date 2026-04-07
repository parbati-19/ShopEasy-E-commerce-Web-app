<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'session_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($cartItem) {
    //         // Optionally, you can perform actions when a cart item is deleted
    //         // For example, you might want to update inventory or log the deletion

    //     });
    // }

}
