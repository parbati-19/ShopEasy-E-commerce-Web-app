<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'image',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeFeatured($query, $productId = null)
    {
        $query->where('is_featured', true);

        if ($productId !== null) {
            $query->where('product_id', $productId);
        }

        return $query;
    }
}