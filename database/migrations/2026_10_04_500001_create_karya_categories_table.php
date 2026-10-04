<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('karya_categories')) {
            return;
        }

        Schema::create('karya_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();                  // slug
            $table->string('label');                          // "Aplikasi & IT"
            $table->string('icon', 60)->default('fa-star');   // class FontAwesome
            $table->string('description', 255)->nullable();   // teks kecil di kartu "Lima bidang"
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_categories');
    }
};
