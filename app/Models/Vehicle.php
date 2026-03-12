<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug', 'title', 'user_id', 'brand_id', 'car_model_id', 'body_type_id',
        'year', 'mileage', 'condition', 'transmission', 'fuel_type', 'drive_type',
        'engine_cc', 'color', 'doors', 'seats', 'interior_color', 'description',
        'price', 'is_negotiable', 'currency', 'county', 'location_text',
        'availability', 'import_country', 'status', 'is_featured', 'is_verified',
        'is_boosted', 'boosted_until', 'expires_at', 'approved_at', 'rejected_reason',
        'auto_score', 'auto_score_breakdown', 'views_count', 'enquiries_count',
        'saves_count', 'cover_image_url',
    ];

    protected $casts = [
        'is_negotiable'       => 'boolean',
        'is_featured'         => 'boolean',
        'is_verified'         => 'boolean',
        'is_boosted'          => 'boolean',
        'boosted_until'       => 'datetime',
        'expires_at'          => 'datetime',
        'approved_at'         => 'datetime',
        'auto_score_breakdown'=> 'array',
    ];

    // ── Relations ──────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'vehicle_features');
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function savedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_vehicles')->withTimestamps();
    }

    // ── Scopes ─────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBoosted($query)
    {
        return $query->where('is_boosted', true)
                     ->where('boosted_until', '>', now());
    }

    // ── Helpers ────────────────────────────────────────────────

    public function getFormattedPriceAttribute(): string
    {
        return 'KES ' . number_format($this->price);
    }

    public function getFormattedMileageAttribute(): string
    {
        return number_format($this->mileage) . ' km';
    }

    public function getWhatsAppLinkAttribute(): string
    {
        $msg   = urlencode("Hi, I'm interested in your {$this->title} listed on AutoVault. Is it still available?");
        $phone = $this->user?->whatsapp_number ?? $this->user?->phone ?? '';
        // Normalise to international format: 07xx → 2547xx
        $phone = preg_replace('/\D/', '', $phone);
        if (strlen($phone) === 10 && str_starts_with($phone, '0')) {
            $phone = '254' . substr($phone, 1);
        }
        return $phone ? "https://wa.me/{$phone}?text={$msg}" : "https://wa.me/?text={$msg}";
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
