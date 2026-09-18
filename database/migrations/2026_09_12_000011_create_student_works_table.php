<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_works', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('student_name');
            $table->uuid('major_id')->nullable();
            $table->text('description')->nullable();
            $table->string('media_url')->nullable();
            $table->string('status')->default('PUBLISHED'); // PENDING, PUBLISHED
            $table->timestamps();

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_works');
    }
};
