<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('berita_placements')) {
            return;
        }

        Schema::create('berita_placements', function (Blueprint $table) {
            $table->id();
            $table->string('slot');                 // 'featured' | 'side' | 'most_read'
            $table->unsignedInteger('position');     // urutan dalam slot (0-based)
            $table->foreignId('article_id')->constrained('berita_articles')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['slot', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_placements');
    }
};
