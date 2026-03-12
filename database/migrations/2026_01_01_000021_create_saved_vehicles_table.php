<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable(); // for guests
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'vehicle_id']);
            $table->index(['session_id', 'vehicle_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_vehicles');
    }
};
