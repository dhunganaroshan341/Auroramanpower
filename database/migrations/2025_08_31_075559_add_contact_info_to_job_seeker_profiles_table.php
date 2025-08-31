<?php
// database/migrations/2025_08_31_000002_add_contact_info_to_job_seeker_profiles.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            $table->string('name')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone']);
        });
    }
};
