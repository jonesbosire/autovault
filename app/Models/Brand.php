<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'logo_url', 'is_popular', 'sort_order', 'is_active'];

    protected $casts = ['is_popular' => 'boolean', 'is_active' => 'boolean'];

    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
