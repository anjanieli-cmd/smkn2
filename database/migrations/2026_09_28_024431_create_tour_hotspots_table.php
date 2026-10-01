<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_hotspots', function (Blueprint $table) {
            $table->id();

            // Scene tempat hotspot ini muncul
            $table->foreignId('tour_scene_id')->constrained('tour_scenes')->cascadeOnDelete();
            // Scene tujuan saat hotspot ini diklik
            $table->foreignId('target_scene_id')->constrained('tour_scenes')->cascadeOnDelete();

            $table->decimal('pitch', 8, 3);
            $table->decimal('yaw', 8, 3);
            $table->string('label');
            $table->string('icon')->default('fa-plus');

            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_hotspots');
    }
};
