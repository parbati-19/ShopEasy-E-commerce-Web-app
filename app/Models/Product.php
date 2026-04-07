<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'stock',
        'sku',
        'category_id',
        'is_active',
        'is_featured',
        'is_flash',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_flash' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeFlash($query)
    {
        return $query->where('is_flash', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', '%' . $term . '%')
                   ->orWhere('description', 'like', '%' . $term . '%');
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }

    public function getImageUrlAttribute()
    {
        $image = $this->images()->first();
        return $image ? asset('storage/' . $image->image) : null;
    }

    public function getInStockAttribute()
    {
        return $this->stock > 0;
    }

    public function getIsOnSaleAttribute()
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    protected static function boot(){
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}