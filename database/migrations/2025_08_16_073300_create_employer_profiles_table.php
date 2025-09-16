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
        Schema::create('employer_profiles', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->nullable(); // if you want to link employer to login
    $table->string('company_name');
    $table->string('contact_person');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('country')->nullable();
    $table->string('city')->nullable();
    $table->text('company_details')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};
