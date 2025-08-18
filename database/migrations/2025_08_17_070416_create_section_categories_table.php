<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('section_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Category name
            $table->string('sub_heading'); // Category name
            $table->string('image')->nullable(); // Category name
            $table->string('video')->nullable(); // Category name
            $table->string('slug')->unique()->nullable(); // optional slug for URLs
            $table->text('description')->nullable(); // optional description
            $table->text('description2')->nullable(); // optional description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_categories');
    }
};
