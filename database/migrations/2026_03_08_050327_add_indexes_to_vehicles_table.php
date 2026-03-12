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
            $table->index('approved_at');
            $table->index('deleted_at');
            $table->index(['status', 'approved_at']); // composite for active + sort
            $table->index(['status', 'is_featured']);  // composite for featured listing
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['approved_at']);
            $table->dropIndex(['deleted_at']);
            $table->dropIndex(['status', 'approved_at']);
            $table->dropIndex(['status', 'is_featured']);
        });
    }
};
