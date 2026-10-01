<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gallery_id');
            $table->string('photo_url');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_photos');
    }
};
