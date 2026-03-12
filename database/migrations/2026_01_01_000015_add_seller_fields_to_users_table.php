<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('seller')->after('email'); // seller, admin, super_admin
            $table->string('phone')->nullable()->after('role');
            $table->string('google_id')->nullable()->after('phone');
            $table->string('avatar_url')->nullable()->after('google_id');
            $table->string('status')->default('active')->after('avatar_url'); // active, suspended
            $table->boolean('is_verified')->default(false)->after('status');
            $table->timestamp('phone_verified_at')->nullable()->after('is_verified');
            $table->string('id_number')->nullable()->after('phone_verified_at'); // national ID for KYC
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'google_id', 'avatar_url', 'status', 'is_verified', 'phone_verified_at', 'id_number']);
        });
    }
};
