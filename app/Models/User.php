<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'whatsapp_number', 'google_id',
        'avatar_url', 'status', 'is_verified', 'phone_verified_at', 'id_number',
    ];

    protected $hidden = ['password', 'remember_token', 'google_id'];

    protected function casts(): array
    {
        return [
            'email_verified_at'  => 'datetime',
            'phone_verified_at'  => 'datetime',
            'password'           => 'hashed',
            'is_verified'        => 'boolean',
        ];
    }

    // ── Relations ──────────────────────────────────────────────

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
                    ->where('status', 'active')
                    ->where('ends_at', '>', now())
                    ->latestOfMany();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function savedVehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'saved_vehicles')->withTimestamps();
    }

    // ── Role Helpers ───────────────────────────────────────────

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription !== null;
    }

    public function canListVehicle(): bool
    {
        if ($this->isAdmin()) {
            return true;
        }
        $sub = $this->activeSubscription;
        if (! $sub) {
            return false;
        }
        $plan = $sub->plan;
        if ($plan->isUnlimited()) {
            return true;
        }
        return $this->vehicles()->whereIn('status', ['active', 'pending_review'])->count() < $plan->max_listings;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() && ! $this->isSuspended();
    }
}

