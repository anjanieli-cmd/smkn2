<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan_placements')) {
            return;
        }

        Schema::create('kegiatan_placements', function (Blueprint $table) {
            $table->id();
            $table->string('slot', 20);                            // featured | pick_big | pick_small
            $table->unsignedTinyInteger('position')->default(0);
            $table->foreignId('album_id')->constrained('kegiatan_albums')->cascadeOnDelete();
            $table->string('label', 255)->nullable();              // tag / kutipan / label pendek
            $table->timestamps();
            $table->unique(['slot', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_placements');
    }
};
