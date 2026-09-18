<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('category')->default('Kegiatan Sekolah'); // Kegiatan Sekolah, Prestasi
            $table->text('description')->nullable();
            $table->string('image_url');
            $table->date('event_date')->nullable();
            $table->timestamps();

            $table->index(['category', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
