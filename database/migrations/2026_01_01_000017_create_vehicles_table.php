<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title'); // auto-generated: "2020 Toyota Camry"
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // seller (null = admin listed)
            $table->foreignId('brand_id')->constrained()->restrictOnDelete();
            $table->foreignId('car_model_id')->constrained()->restrictOnDelete();
            $table->foreignId('body_type_id')->nullable()->constrained()->nullOnDelete();

            // Core specs
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('mileage')->default(0); // in km
            $table->string('condition'); // new, foreign_used, locally_used
            $table->string('transmission'); // automatic, manual, cvt, amt
            $table->string('fuel_type'); // petrol, diesel, hybrid, electric, lpg
            $table->string('drive_type')->nullable(); // 4WD, AWD, FWD, RWD
            $table->string('engine_cc')->nullable(); // e.g. "2000cc"
            $table->string('color')->nullable();
            $table->unsignedTinyInteger('doors')->default(4);
            $table->unsignedTinyInteger('seats')->default(5);
            $table->string('interior_color')->nullable();
            $table->text('description')->nullable();

            // Pricing
            $table->unsignedBigInteger('price'); // in KES
            $table->boolean('is_negotiable')->default(false);
            $table->string('currency')->default('KES');

            // Location
            $table->string('county')->nullable(); // Nairobi, Mombasa, etc.
            $table->string('location_text')->nullable(); // e.g. "Westlands, Nairobi"

            // Import info
            $table->string('availability')->default('local'); // local, import
            $table->string('import_country')->nullable(); // Japan, UK, etc.

            // Status & visibility
            $table->string('status')->default('draft');
            // draft, pending_payment, pending_review, active, rejected, sold, expired, paused

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_boosted')->default(false);
            $table->timestamp('boosted_until')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('rejected_reason')->nullable();

            // AutoScore
            $table->unsignedTinyInteger('auto_score')->nullable(); // 0-100
            $table->json('auto_score_breakdown')->nullable();

            // Stats
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('enquiries_count')->default(0);
            $table->unsignedInteger('saves_count')->default(0);

            // Cover image (cached for performance)
            $table->string('cover_image_url')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes for common filter queries
            $table->index(['status', 'is_featured', 'is_boosted']);
            $table->index(['brand_id', 'status']);
            $table->index(['body_type_id', 'status']);
            $table->index(['price', 'status']);
            $table->index(['year', 'status']);
            $table->index(['county', 'status']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
