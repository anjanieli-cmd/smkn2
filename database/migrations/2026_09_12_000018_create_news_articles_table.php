<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->text('content');
            $table->string('category')->default('Berita Utama');
            $table->string('image_url')->nullable();
            $table->string('author_name')->default('Admin Sekolah');
            $table->string('status')->default('PUBLISHED'); // DRAFT, PUBLISHED
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'published_at', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
