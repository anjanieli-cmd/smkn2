<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan_categories')) {
            return;
        }

        Schema::create('kegiatan_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();      // slug, dipakai sebagai data-filter
            $table->string('label');
            $table->string('icon', 60)->default('fa-flag');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_categories');
    }
};
