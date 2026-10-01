<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_scenes', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category')->default('area'); // area | kelas | fasilitas
            $table->string('icon')->default('fa-archway'); // FontAwesome class, tanpa "fas "
            $table->text('description')->nullable();

            $table->string('panorama')->nullable(); // path foto equirectangular

            // Parameter Pannellum — vaov biasanya di-auto-hitung dari dimensi foto saat upload
            $table->unsignedSmallInteger('haov')->default(360);
            $table->decimal('vaov', 6, 2)->default(180);
            $table->integer('v_offset')->default(0);

            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_home')->default(false); // scene yang dibuka pertama kali

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_scenes');
    }
};
