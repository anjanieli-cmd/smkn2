<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('berita_articles')) {
            return;
        }

        Schema::create('berita_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_key')->nullable();     // -> berita_categories.key
            $table->string('date_label')->nullable();        // teks bebas: "23 Juli 2025", "September 2024", boleh kosong
            $table->string('excerpt', 1000)->nullable();      // ringkasan singkat di kartu
            $table->longText('content')->nullable();          // isi lengkap modal: satu paragraf per baris
            $table->string('photo')->nullable();              // 'images/...' (public) atau path storage
            $table->boolean('show_in_initial_ten')->default(true); // true = tampil sebelum "Lihat Semua" ditekan
            $table->unsignedInteger('order')->default(0);     // urutan di daftar Berita Terbaru
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_articles');
    }
};
