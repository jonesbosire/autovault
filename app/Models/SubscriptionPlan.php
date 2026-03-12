<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price_monthly', 'max_listings',
        'listing_duration_days', 'has_featured_placement', 'has_auto_score',
        'has_verified_badge', 'has_priority_review', 'has_api_access',
        'boost_credits', 'features', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'has_featured_placement' => 'boolean',
        'has_auto_score'         => 'boolean',
        'has_verified_badge'     => 'boolean',
        'has_priority_review'    => 'boolean',
        'has_api_access'         => 'boolean',
        'is_active'              => 'boolean',
        'features'               => 'array',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'KES ' . number_format($this->price_monthly);
    }

    public function isUnlimited(): bool
    {
        return $this->max_listings === 0;
    }
}
