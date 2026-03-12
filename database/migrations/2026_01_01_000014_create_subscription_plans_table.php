<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Starter, Growth, Pro Dealer, Enterprise
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('price_monthly'); // in KES
            $table->unsignedInteger('max_listings');  // 0 = unlimited
            $table->unsignedInteger('listing_duration_days')->default(60);
            $table->boolean('has_featured_placement')->default(false);
            $table->boolean('has_auto_score')->default(false);
            $table->boolean('has_verified_badge')->default(false);
            $table->boolean('has_priority_review')->default(false);
            $table->boolean('has_api_access')->default(false);
            $table->unsignedInteger('boost_credits')->default(0); // free boosts per month
            $table->json('features')->nullable(); // additional features list for display
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
