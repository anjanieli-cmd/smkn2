<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan_photos')) {
            return;
        }

        Schema::create('kegiatan_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('kegiatan_albums')->cascadeOnDelete();
            $table->string('path');                                // foto tambahan di popup album
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_photos');
    }
};
