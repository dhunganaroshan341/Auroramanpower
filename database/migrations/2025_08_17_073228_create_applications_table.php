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
       // database/migrations/2025_08_17_000004_create_applications_table.php
Schema::create('applications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('job_id')->constrained()->onDelete('cascade');
    $table->foreignId('job_seeker_id')->constrained('job_seeker_profiles')->onDelete('cascade');
    $table->text('cover_letter')->nullable();
    $table->enum('status', ['applied','shortlisted','rejected'])->default('applied');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
