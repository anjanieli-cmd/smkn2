<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_achievements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('level')->default('Provinsi'); // Kota/Kabupaten, Provinsi, Nasional, Internasional
            $table->string('year')->default('2026');
            $table->string('winner_name')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->index(['level', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_achievements');
    }
};
