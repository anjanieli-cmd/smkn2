<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_best_alumni', function (Blueprint $table) {
            $table->id();
            $table->string('major_abbr', 30);              // label tombol jurusan, mis. KULINER
            $table->string('major_name');                  // nama lengkap jurusan
            $table->string('name');
            $table->string('year', 20);
            $table->string('code', 50)->nullable();        // mis. "RPL / 2024"
            $table->string('photo')->nullable();           // path relatif dari folder public
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_best_alumni');
    }
};
