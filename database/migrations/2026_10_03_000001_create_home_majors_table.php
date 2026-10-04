<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_majors', function (Blueprint $table) {
            $table->id();
            $table->string('abbr', 30);                    // mis. RPL
            $table->string('full_name');                   // mis. Rekayasa Perangkat Lunak
            $table->string('image')->nullable();           // path relatif dari folder public
            $table->string('url')->nullable();             // halaman tujuan tombol "Lihat Jurusan"
            $table->string('color', 9)->nullable();        // warna kartu, mis. #DB1320
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_majors');
    }
};
