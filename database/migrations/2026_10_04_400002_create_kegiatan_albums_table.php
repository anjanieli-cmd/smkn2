<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan_albums')) {
            return;
        }

        Schema::create('kegiatan_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_key')->nullable();            // -> kegiatan_categories.key
            $table->string('date_label')->nullable();              // teks bebas: "2026", "25 Desember 2025"
            $table->text('description')->nullable();               // keterangan di popup album
            $table->string('photo')->nullable();                   // foto sampul: 'images/...' atau path storage
            $table->string('size', 12)->default('auto');           // auto|standard|md|lg|wide|tall
            $table->boolean('show_in_gallery')->default(true);     // false = hanya dipakai di Sorotan
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_albums');
    }
};
