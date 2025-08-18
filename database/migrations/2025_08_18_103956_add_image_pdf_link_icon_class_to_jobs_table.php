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
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            $table->string('link')->nullable();
            $table->string('icon_class')->nullable();
            $table->unsignedBigInteger('our_country_id')->nullable(); // add this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
};
