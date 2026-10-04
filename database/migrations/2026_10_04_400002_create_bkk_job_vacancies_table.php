<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bkk_job_vacancies')) {
            return;
        }

        Schema::create('bkk_job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->string('location')->nullable();
            $table->string('employment_type', 60)->nullable();      // Full-Time, Magang, Kontrak, dst.
            $table->string('status', 20)->default('OPEN')->index();  // OPEN | UPCOMING | SELESAI | ARSIP
            $table->date('deadline')->nullable();
            $table->string('apply_url', 500)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_job_vacancies');
    }
};
