<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('struktur_roles')) {
            return;
        }

        Schema::create('struktur_roles', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 60)->nullable();
            $table->string('title');
            $table->text('text')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_roles');
    }
};
