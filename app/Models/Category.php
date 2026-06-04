<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// A Category represents a Turkish city (Istanbul, Cappadocia, etc.)
class Category extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    // One city has many tours
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
