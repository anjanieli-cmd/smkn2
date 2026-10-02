<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('berita_categories')) {
            return;
        }

        Schema::create('berita_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();   // slug, dipakai sebagai data-filter (tidak berubah setelah dibuat)
            $table->string('label');
            $table->string('color', 20)->default('sekolah'); // nama warna chip: sekolah/siswa/prestasi/kegiatan/akademik/ekstrakurikuler/humas
            $table->string('icon', 60)->default('fa-newspaper');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_categories');
    }
};
