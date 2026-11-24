<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price',
        'min_order', 'image', 'is_available', 'is_featured',
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->image ? '/storage/'.$this->image : null);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}