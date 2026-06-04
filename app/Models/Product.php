<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// A Product is a tour package (e.g. "Bosphorus Cruise", "Cappadocia Hot Air Balloon")
class Product extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'duration_days',
        'image',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price'        => 'decimal:2',
    ];

    // Each tour belongs to one city (category)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // A tour can appear in many order items (bookings)
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
