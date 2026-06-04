<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// An Order represents one customer booking (may contain multiple tours)
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'customer_name',
        'customer_phone',
        'travel_date',
    ];

    // The user who placed this booking
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // All the individual tours inside this booking
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
