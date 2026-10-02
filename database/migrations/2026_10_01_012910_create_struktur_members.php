<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('struktur_members')) {
            return;
        }

        Schema::create('struktur_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('level')->default(2)->index(); // 1 pimpinan | 2 wakil | 3 unit pelaksana
            $table->string('bidang', 30)->default('pimpinan');         // kunci filter, lihat StrukturMember::BIDANG
            $table->string('position');                                // judul kartu, mis. "Waka Kurikulum"
            $table->string('person')->nullable();                      // nama orang + gelar
            $table->string('badge')->nullable();                       // teks pil kecil; kosong = sama dengan jabatan
            $table->string('unit')->nullable();                        // dipakai pencarian + tag di modal
            $table->text('description')->nullable();                   // kalimat singkat di kartu
            $table->string('icon', 60)->default('fa-user');            // FontAwesome, tanpa "fas "
            $table->string('photo')->nullable();                       // path foto (public/ lama atau storage baru)
            $table->text('tasks')->nullable();                         // satu tugas per baris (isi modal)
            $table->string('note', 500)->nullable();                   // catatan opsional di modal
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_members');
    }
};
