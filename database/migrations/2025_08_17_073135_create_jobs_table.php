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
       // database/migrations/2025_08_17_000003_create_jobs_table.php
Schema::create('jobs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('employer_id')->nullable()->constrained('employer_profiles')->onDelete('set null');
    $table->string('title');
    $table->text('description');
    $table->text('requirements')->nullable();
    $table->string('location')->nullable();
    $table->string('salary')->nullable();
    $table->enum('status', ['active','inactive'])->default('active');
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
