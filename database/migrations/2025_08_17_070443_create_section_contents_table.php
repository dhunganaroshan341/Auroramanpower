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
        Schema::create('section_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_category_id')->constrained()->onDelete('cascade'); // relation
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('pdf')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description2')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('link_title')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_contents');
    }
};
