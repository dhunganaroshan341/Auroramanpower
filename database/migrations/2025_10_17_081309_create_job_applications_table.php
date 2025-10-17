<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->cascadeOnDelete();
            $table->foreignId('job_seeker_profile_id')->nullable()->constrained()->nullOnDelete();

            // Manual applicant fields
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('resume_file')->nullable();
            $table->text('bio')->nullable();
            $table->string('desired_role')->nullable();

            // Application status
            $table->enum('status', ['Pending', 'Reviewed', 'Accepted', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
