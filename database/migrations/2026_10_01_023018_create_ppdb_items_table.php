<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('ppdb_items')) {
            return;
        }

        // Satu tabel untuk semua daftar di halaman PPDB (dibedakan kolom "section"):
        // definisi | jalur | syarat | alur | jadwal | jurusan | faq
        Schema::create('ppdb_items', function (Blueprint $table) {
            $table->id();
            $table->string('section', 20)->index();
            $table->string('icon', 60)->nullable();        // FontAwesome, tanpa "fas " (jalur, syarat)
            $table->string('title');                       // judul / nama / pertanyaan / kegiatan
            $table->string('label')->nullable();           // kuota (jalur) | label kecil (jurusan) | waktu (jadwal)
            $table->text('text')->nullable();              // keterangan / jawaban
            $table->string('photo')->nullable();           // foto (jurusan): path public/ lama atau storage baru
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_items');
    }
};
