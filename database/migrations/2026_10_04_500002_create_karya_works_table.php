<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('karya_works')) {
            return;
        }

        Schema::create('karya_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();                   // 'images/...' atau path storage
            $table->string('category_key')->nullable();            // -> karya_categories.key
            $table->string('tag_label', 100)->nullable();          // label di slider, mis. "Makanan" (kosong = nama kategori)
            $table->string('tag_icon', 60)->nullable();            // ikon tag/medali (kosong = ikon kategori)
            $table->string('student_label', 150)->nullable();      // "Tim APHP Angkatan 2023"
            $table->string('major_label', 150)->nullable();        // nama lengkap jurusan
            $table->string('major_icon', 60)->nullable();
            $table->string('major_short', 60)->nullable();         // singkatan untuk kartu produk: "APHP"
            $table->string('year_label', 60)->nullable();          // "2025"
            $table->boolean('show_in_slider')->default(true);
            $table->boolean('show_in_products')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_works');
    }
};
