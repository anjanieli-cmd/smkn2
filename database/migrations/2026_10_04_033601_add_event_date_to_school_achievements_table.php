<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambah kolom pada school_achievements supaya semua data halaman Prestasi
 * (yang sebelumnya tertulis mati di Blade) bisa disimpan dan diedit dari admin.
 * Aman dijalankan di database yang sudah berisi data: hanya MENAMBAH kolom.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_achievements', function (Blueprint $table) {
            if (!Schema::hasColumn('school_achievements', 'level_label')) {
                $table->string('level_label')->nullable()->after('level');   // mis. "Kota Mojokerto", "Jawa Timur"
            }
            if (!Schema::hasColumn('school_achievements', 'rank')) {
                $table->string('rank')->nullable()->after('year');           // mis. "Juara 1"
            }
            if (!Schema::hasColumn('school_achievements', 'tag')) {
                $table->string('tag')->nullable()->after('rank');            // mis. "RPL", "Olahraga"
            }
            if (!Schema::hasColumn('school_achievements', 'event_date')) {
                $table->date('event_date')->nullable()->after('tag');        // tanggal berita/capaian
            }
            if (!Schema::hasColumn('school_achievements', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('image_url');
            }
            if (!Schema::hasColumn('school_achievements', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
        });
    }

    public function down(): void
    {
        Schema::table('school_achievements', function (Blueprint $table) {
            foreach (['level_label', 'rank', 'tag', 'event_date', 'is_featured', 'is_active'] as $col) {
                if (Schema::hasColumn('school_achievements', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};