<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('male_opening')->default(0);
            $table->integer('female_opening')->default(0);
            $table->integer('total_openings')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['male_opening', 'female_opening', 'total_openings']);
        });
    }
};
