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
        Schema::table('vacancies', function (Blueprint $table) {
            // Client info
            $table->foreignId('client_id')
                ->nullable()
                ->constrained()
                ->after('id')
                ->onDelete('set null'); // existing client
            $table->string('custom_company_name')->nullable()->after('client_id');
            $table->string('custom_company_country')->nullable()->after('custom_company_name');

            // Vacancy details
            $table->string('title')->nullable()->after('custom_company_country');
            $table->string('currency')->default('USD')->after('title');
            $table->date('interview_date')->nullable()->after('currency');
            $table->text('general_requirements')->nullable()->after('interview_date');
            $table->string('vacancy_image')->nullable()->after('general_requirements'); // path to image
            $table->text('description')->after('vacancy_image');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn([
                'client_id',
                'custom_company_name',
                'custom_company_country',
                'title',
                'currency',
                'interview_date',
                'general_requirements',
                'vacancy_image',
                'description',
                'status',
            ]);
        });
    }
};
