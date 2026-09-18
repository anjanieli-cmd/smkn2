<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('company_name');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('apply_url')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status')->default('ACTIVE'); // ACTIVE, EXPIRED
            $table->timestamps();

            $table->index(['status', 'deadline']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
