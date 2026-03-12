<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->index(['status', 'condition']);
            $table->index(['status', 'availability']);
            $table->index(['status', 'is_boosted', 'approved_at']);
            $table->index('views_count');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['status', 'condition']);
            $table->dropIndex(['status', 'availability']);
            $table->dropIndex(['status', 'is_boosted', 'approved_at']);
            $table->dropIndex(['views_count']);
        });
    }
};
