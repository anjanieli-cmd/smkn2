<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('berita_stories')) {
            return;
        }

        Schema::create('berita_stories', function (Blueprint $table) {
            $table->id();
            $table->string('category_key')->nullable();  // -> berita_categories.key (label kartu & modal)
            $table->string('title');
            $table->string('teaser', 500)->nullable();     // 1-2 kalimat di kartu
            $table->longText('content')->nullable();       // isi modal: satu paragraf per baris
            $table->unsignedInteger('order')->default(0);  // 1..3
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_stories');
    }
};
