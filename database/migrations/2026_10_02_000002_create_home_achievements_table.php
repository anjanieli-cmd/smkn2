<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();          // path relatif dari folder public
            $table->string('tag')->nullable();            // mis. "Medali Perak — Nasional"
            $table->string('title');                      // mis. "LKS Nasional"
            $table->string('subtitle')->nullable();       // bagian judul berwarna emas
            $table->text('description')->nullable();
            $table->string('year', 20)->nullable();
            $table->string('meta_label', 100)->nullable(); // mis. "Tingkat Nasional"
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_achievements');
    }
};
