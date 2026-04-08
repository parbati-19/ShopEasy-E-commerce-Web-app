<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'type' => 'product',
            'title' => $this->name,
            'sub_title' => $this->category->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'price' => [
                'original' => $this->compare_price ?? null,
                'current' => $this->price,
                'formatted' => '$'. number_format($this->price,2),
            ],
            'featured_image' => $this->images->is_featured ? $this->images : null,
            'images' => $this->images,
            'stock' => [
                'available' => $this->stock,
                'in_stock' => $this->stock > 0,
                'low_stock' => $this->stock > 0 && $this->stock <= 10
            ],
            'is_featured' => $this->is_featured,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]
        ];
    }
}
