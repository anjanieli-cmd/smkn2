<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('photo_url')->nullable();
            $table->integer('graduation_year');
            $table->uuid('major_id')->nullable();
            $table->string('status')->default('OTHER'); // STUDYING, WORKING, ENTREPRENEUR, OTHER
            $table->string('university')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->string('career_field')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Indonesia');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('publication_status')->default('PUBLISHED'); // DRAFT, PUBLISHED
            $table->timestamps();

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
            $table->index(['publication_status', 'graduation_year']);
            $table->index(['city', 'country']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
