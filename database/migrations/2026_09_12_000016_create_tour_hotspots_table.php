<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_hotspots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('location_id');
            $table->uuid('target_location_id')->nullable();
            $table->string('title');
            $table->decimal('pitch', 8, 4)->default(0);
            $table->decimal('yaw', 8, 4)->default(0);
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('tour_locations')->onDelete('cascade');
            $table->foreign('target_location_id')->references('id')->on('tour_locations')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_hotspots');
    }
};
