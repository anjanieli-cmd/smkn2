<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roadmap_phases', function (Blueprint $table) {
            $table->id();
            $table->string('year', 20);
            $table->string('icon', 60)->default('fa-flag');
            $table->string('title');
            $table->text('text')->nullable();
            $table->json('items')->nullable();      // daftar poin program (array of string)
            $table->string('tag', 60)->nullable();
            $table->boolean('is_goal')->default(false); // fase target akhir (badge "Target ...")
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap_phases');
    }
};
