<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('author_name');
            $table->uuid('alumni_id')->nullable();
            $table->string('category')->default('OTHER'); // CODING, DESIGN, RESEARCH, BUSINESS, MULTIMEDIA, OTHER
            $table->string('project_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->string('status')->default('PENDING'); // DRAFT, PENDING, PUBLISHED, REJECTED
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('set null');
            $table->index(['status', 'category', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
