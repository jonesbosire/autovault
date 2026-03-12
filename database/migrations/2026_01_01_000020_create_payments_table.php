<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subscription_plan_id')->nullable()->constrained()->nullOnDelete();
            $table->string('reference')->unique(); // our internal ref
            $table->string('gateway_reference')->nullable(); // Mpesa/Flutterwave transaction ID
            $table->string('type'); // listing_fee, subscription, boost, inspection
            $table->string('gateway'); // mpesa, flutterwave, manual
            $table->unsignedInteger('amount'); // in KES
            $table->string('currency')->default('KES');
            $table->string('status')->default('pending'); // pending, completed, failed, refunded
            $table->string('phone')->nullable(); // for mpesa
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['status', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
