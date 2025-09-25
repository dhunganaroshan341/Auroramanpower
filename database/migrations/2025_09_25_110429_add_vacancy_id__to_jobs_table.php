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
            $table->foreignId('vacancy_id')
                  ->after('id') // optional: place after id
                  ->nullable()
                  ->constrained('vacancies')
                  ->onDelete('cascade'); // delete jobs if vacancy deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['vacancy_id']);
            $table->dropColumn('vacancy_id');
        });
    }
};
